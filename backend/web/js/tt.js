if (typeof window.YiiApp === 'undefined') {
    window.YiiApp = {};
}

YiiApp.CommonFunctionsModule = {};

YiiApp.CommonFunctionsModule.isEmptyObject = function (obj) {

    var hasOwnProperty = Object.prototype.hasOwnProperty;

    // null and undefined are "empty"
    if (obj == null) return true;

    // Assume if it has a length property with a non-zero value
    // that that property is correct.
    if (obj.length > 0) return false;
    if (obj.length === 0) return true;

    // Otherwise, does it have any properties of its own?
    // Note that this doesn't handle
    // toString and valueOf enumeration bugs in IE < 9
    for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) return false;
    }

    return true;
};

/*
 * See http://blog.stevenlevithan.com/archives/javascript-match-recursive-regexp
 */
YiiApp.CommonFunctionsModule.matchRecursiveRegExp = function (str, left, right, flags) {

    var f = flags || '',
        g = f.indexOf("g") > -1,
        x = new RegExp(left + "|" + right, 'g' + f.replace(/g/g, '')),
        l = new RegExp(left, f.replace(/g/g, '')),
        a = [],
        t, s, m;

    do {
        t = 0;
        while (m = x.exec(str)) {
            if (l.test(m[0])) {
                if (!t++) s = x.lastIndex;
            } else if (t) {
                if (!--t) {
                    a.push(str.slice(s, m.index));
                    if (!g) return a;
                }
            }
        }
    } while (t && (x.lastIndex = s));

    return a;
};

YiiApp.ttLib = {

    defaultCurrency: 'USD',

    parseToken: function (token) {

        var result = token.split(/,\s*/);

        if (result.length > 3) {
            // Если элементов больше трех, то пакуем остаток в элемент [2]
            // TODO Может быть проблема с пробелами, так как регулярка их съест, и неизвестно были они или нет.
            result[2] = result.splice(2).join();
        }

        var elements = {
            // Параметр
            'param': result[0],
            // Тип обработчика
            'type': result[1]
        };

        // Если есть правила
        if (typeof result[2] !== 'undefined') {
            elements.rule = result[2];
        }

        console.log('Parsed token "' + token + '": ');
        console.log(elements);

        return elements;
    },

    processToken: function (token, paramValue) {

        switch (token.type) {

            case 'plural':
                return YiiApp.ttLib.processRulePlural(token, paramValue);
                break;

            case 'number':
                return YiiApp.ttLib.processRuleNumber(token, paramValue);
                break;

            case 'datetime':
                return YiiApp.ttLib.processRuleDateTime(token, paramValue);
                break;

            case 'date':
                return YiiApp.ttLib.processRuleDate(token, paramValue);
                break;

            case 'time':
                return YiiApp.ttLib.processRuleTime(token, paramValue);
                break;

            case 'timespan':
                return YiiApp.ttLib.processRuleTimespan(token, paramValue);
                break;

            case 'spellout':
                return YiiApp.ttLib.processRuleSpellout(token, paramValue);
                break;

            case 'ordinal':
                return YiiApp.ttLib.processRuleOrdinal(token, paramValue);
                break;

            case 'duration':
                return YiiApp.ttLib.processRuleDuration(token, paramValue);
                break;

            case 'none':
            default :
                // Без обработки
                return paramValue;
                break;
        }

    },

    processRulePlural: function (token, paramValue) {

        if (typeof token.rule !== 'undefined') {

            // Получаем субтокены из правила
            // Правило вида: =0{are no cats} =1{is one cat} other{are # cats}
            // Поэтому нужно будет еще зафиксировать номера (или значение) перед токеном
            var subtokens = YiiApp.CommonFunctionsModule.matchRecursiveRegExp(token.rule, '{', '}', 'g');
            var answers = {};

            subtokens.forEach(function (element, index, array) {

                var re = /\b=?(\d+|zero|one|two|few|many|other)\{[^}]+}/gi;
                var matches = token.rule.match(re);

                console.log('Element "' + element + '" has found in the rule: "' + matches[index] + '".');

                if (typeof matches[index] !== 'undefined') {

                    var sMatch = re.exec(matches[index]);

                    var ruleset = sMatch[1].trim();

                    switch (ruleset) {

                        case '0':
                            ruleset = 'zero';
                            break;

                        case '1':
                            ruleset = 'one';
                            break;

                        case '2':
                            ruleset = 'two';
                            break;

                        default:
                            break;
                    }

                    console.log('Element "' + element + '" has ruleset "' + ruleset + '".');

                    answers[ruleset] = element;

                    // Замена знака # на переданное значение
                    if (/*ruleset == 'other' && */ element.contains('#')) {
                        answers[ruleset] = element.replace('#', paramValue);
                    }
                }

            });

            // Доступные правила для языка можно получить через TwitterCldr.PluralRules.all();
            // Но по идее правила уже должны быть адаптированы переводчиком для языка

            // Теперь применяем простые правила, которые можем рассчитать без дополнительной информации
            if (paramValue == 0 && answers.hasOwnProperty('zero')) {

                //noinspection JSUnresolvedVariable
                return answers.zero;

            } else if (paramValue == 1 && answers.hasOwnProperty('one')) {

                //noinspection JSUnresolvedVariable
                return answers.one;

            } else if (paramValue == 2 && answers.hasOwnProperty('two')) {

                //noinspection JSUnresolvedVariable
                return answers.two;

            } else {

                // Если есть правило "другие", но нет правил для "few", "many", то возвращаем правило "other"
                if (answers.hasOwnProperty('other') && !answers.hasOwnProperty('few') && !answers.hasOwnProperty('many')) {

                    //noinspection JSUnresolvedVariable
                    return answers.other;

                } else {

                    //noinspection JSUnresolvedVariable
                    if (typeof TwitterCldr !== 'undefined') {

                        // Обработка по правилам ICU
                        //noinspection JSUnresolvedVariable
                        var ruleset = TwitterCldr.PluralRules.rule_for(paramValue);

                        console.log('The rule for value "' + paramValue + '" is "' + ruleset + '".');

                        if (answers.hasOwnProperty(ruleset)) {

                            // Ответ для правила найден
                            return answers[ruleset];

                        } else {

                            // Не найден ответ для правила
                            console.log('Can\'t find answer body for rule "' + ruleset + '".');
                            return paramValue;
                        }

                    } else {

                        // Объект TwitterCldr не найден (нет файла для примененной локали)
                        console.log('Can\'t find Twitter CDLR data object.');
                        return paramValue;
                    }

                }

            }

        } else {
            return paramValue;
        }

    },

    processRuleSelect: function (token, paramValue) {

        console.log('Not implemented ' + token + '.');
        return paramValue;
    },

    processRuleNumber: function (token, paramValue) {

        //noinspection JSUnresolvedVariable
        if (typeof TwitterCldr !== 'undefined') {

            var rule = 'integer';

            if (token.hasOwnProperty('rule')) {
                rule = token.rule;
            }

            var fmt,
                options = {};

            switch (rule) {

                case 'integer':

                    //noinspection JSUnresolvedVariable
                    fmt = new TwitterCldr.DecimalFormatter();

                    return fmt.format(paramValue);

                    break;

                case 'float':

                    //noinspection JSUnresolvedVariable
                    fmt = new TwitterCldr.DecimalFormatter();

                    options.precision = 2;

                    if (typeof paramValue === 'object') {

                        options.precision = paramValue.hasOwnProperty('precision') ? paramValue.precision : 2;

                        return fmt.format(paramValue.value, options);

                    } else {
                        return fmt.format(paramValue, options);
                    }

                    break;

                case 'shortInteger':

                    //noinspection JSUnresolvedVariable
                    fmt = new TwitterCldr.ShortDecimalFormatter();

                    return fmt.format(paramValue);

                    break;

                case 'longInteger':

                    //noinspection JSUnresolvedVariable
                    fmt = new TwitterCldr.LongDecimalFormatter();

                    return fmt.format(paramValue);

                    break;

                case 'currency':

                    //noinspection JSUnresolvedVariable
                    fmt = new TwitterCldr.CurrencyFormatter();

                    if (typeof paramValue === 'object') {

                        // заданное значение, или значение по умолчанию, или значение библиотеки по умолчанию
                        options.currency = paramValue.currency || YiiApp.ttData.params.currency || YiiApp.ttLib.defaultCurrency;
                        options.precision = paramValue.hasOwnProperty('precision') ? paramValue.precision : undefined;

                        return fmt.format(paramValue.value, options);

                    } else {

                        // значение по умолчанию, или значение библиотеки по умолчанию
                        options.currency = YiiApp.ttData.params.currency || YiiApp.ttLib.defaultCurrency;

                        // значение по умолчанию, или значение библиотеки по умолчанию
                        return fmt.format(paramValue, options);
                    }

                    break;

                case 'percent':

                    //noinspection JSUnresolvedVariable
                    fmt = new TwitterCldr.PercentFormatter();

                    if (typeof paramValue === 'object') {

                        options.precision = paramValue.hasOwnProperty('precision') ? paramValue.precision : 2;

                        return fmt.format(paramValue.value, options);

                    } else {

                        return fmt.format(paramValue);
                    }

                    break;

                default:

                    console.log('Not implemented ' + token + ' with subtype ' + rule + '.');

                    return paramValue;

                    break;
            }

        } else {

            // Объект TwitterCldr не найден (нет файла для примененной локали)
            console.log('Can\'t find Twitter CDLR data object.');
            return paramValue;
        }
    },

    processRuleDateTime: function (token, paramValue, format) {

        format = format || 'date_time';

        //noinspection JSUnresolvedVariable
        if (typeof TwitterCldr === 'undefined') {

            // Объект TwitterCldr не найден (нет файла для примененной локали)
            console.log('Can\'t find Twitter CDLR data object.');
            return paramValue;

        } else {

            var rule = 'medium';

            if (token.hasOwnProperty('rule')) {
                rule = token.rule;
            }

            //noinspection JSUnresolvedVariable
            var fmt = new TwitterCldr.DateTimeFormatter(),
                options = {'format': format};

            switch (rule) {

                case 'short':
                case 'medium':
                case 'long':
                case 'full':

                    options.type = rule;

                    return fmt.format(new Date(paramValue), options);

                    break;

                default:

                    // Другие доступные форматы для локали
                    //noinspection JSUnresolvedVariable
                    var otherFormats = TwitterCldr.DateTimeFormatter.additional_formats();

                    // Проверяем доступность полученного значения
                    if (otherFormats.indexOf(rule) > -1) {

                        options.format = 'additional';
                        options.type = rule;

                        // Если найдено, то используем его
                        return fmt.format(new Date(paramValue), options);

                    } else {

                        console.log('Not implemented ' + token + ' with subtype ' + rule + '.');

                        return paramValue;
                    }

                    break;
            }

        }

    },

    processRuleDate: function (token, paramValue) {

        return YiiApp.ttLib.processRuleDateTime(token, paramValue, 'date');
    },

    processRuleTime: function (token, paramValue) {

        return YiiApp.ttLib.processRuleDateTime(token, paramValue, 'time');
    },

    processRuleTimespan: function (token, paramValue) {

        //noinspection JSUnresolvedVariable
        if (typeof TwitterCldr === 'undefined') {

            // Объект TwitterCldr не найден (нет файла для примененной локали)
            console.log('Can\'t find Twitter CDLR data object.');
            return paramValue;

        } else {

            var rule = null;

            if (token.hasOwnProperty('rule')) {
                rule = token.rule;
            }

            //noinspection JSUnresolvedVariable
            var fmt = new TwitterCldr.TimespanFormatter(),
                now = Math.round(Date.now() / 1000),
                then = now,
                options = {};

            if (rule !== null) {
                options.unit = rule;
            }

            if (typeof paramValue === 'object') {

                for (var prop in paramValue) {

                    if (paramValue.hasOwnProperty(prop) && prop != 'value') {
                        options[prop] = paramValue[prop];
                    }
                }

                then = Math.round(new Date(paramValue.value).getTime() / 1000);

            } else {

                then = Math.round(new Date(paramValue).getTime() / 1000);
            }

            return fmt.format(then - now, options);
        }

    },

    processRuleSpellout: function (token, paramValue) {

        console.log('Not implemented ' + token + '.');
        return paramValue;

        //noinspection JSUnresolvedVariable
        /*if ( typeof TwitterCldr !== 'undefined' ) {

         } else {

         // Объект TwitterCldr не найден (нет файла для примененной локали)
         console.log( 'Can\'t find Twitter CDLR data object.' );
         return paramValue;
         }*/
    },

    processRuleOrdinal: function (token, paramValue) {

        console.log('Not implemented ' + token + '.');
        return paramValue;

        //noinspection JSUnresolvedVariable
        /*if ( typeof TwitterCldr !== 'undefined' ) {

         } else {

         // Объект TwitterCldr не найден (нет файла для примененной локали)
         console.log( 'Can\'t find Twitter CDLR data object.' );
         return paramValue;
         }*/
    },

    processRuleDuration: function (token, paramValue) {

        console.log('Not implemented ' + token + '.');
        return paramValue;

        //noinspection JSUnresolvedVariable
        /*if ( typeof TwitterCldr !== 'undefined' ) {

         } else {

         // Объект TwitterCldr не найден (нет файла для примененной локали)
         console.log( 'Can\'t find Twitter CDLR data object.' );
         return paramValue;
         }*/
    },

    processMessage: function (message, params) {

        if (YiiApp.CommonFunctionsModule.isEmptyObject(params)) {
            // can't replace templates without data
            return message;
        }

        // Регулярка для определения наличия шаблонов ICU в сообщении
        var re = /{\s*[\d\w]+\s*,/;

        if (re.test(message)) {

            // Содержит логику ICU

            var tokens = YiiApp.CommonFunctionsModule.matchRecursiveRegExp(message, '{', '}', 'g');

            tokens.forEach(function (element, index, array) {

                // Парсим токен на компоненты
                var token = YiiApp.ttLib.parseToken(element);
                var paramValue = null;

                // Если среди переданных параметров есть параметр, использованный в токене
                if (typeof params[token.param] !== 'undefined') {

                    paramValue = params[token.param];

                } else {

                    // Если нет, и название параметра в токене равно "n", и
                    // переданные параметры являются массивом, и в них есть нулевой элемент
                    if (token.param == 'n' && Array.isArray(params) && params.length > 0) {
                        paramValue = params[0];
                    }

                }

                // Если среди переданных параметров есть параметр, использованный в токене
                if (paramValue !== null) {

                    // Процессим токен с переданными параметрами
                    var result = YiiApp.ttLib.processToken(token, paramValue);

                    if (typeof result == 'object' && result.hasOwnProperty('value')) {
                        // Если результат в виде объекта, пытаемся выделить значение из него.
                        result = result.value;
                    }

                    // Теперь заменяем найденный токен в сообщении на результат,
                    // который вернул процессинг токена, если результат не false

                    console.log('element: ' + element);
                    console.log('result: ' + result);

                    if (result !== false) {

                        message = message.replace('{' + element + '}', result);
                    }

                }

            });

            return message;

        } else {

            // Обычное сообщение с шаблоном или без

            if (typeof params == 'object') {

                if (Array.isArray(params)) {

                    params.forEach(function (element, index, array) {

                        // Заменяем шаблоны в сообщении
                        message.replace('{' + index + '}', element);
                    });

                } else {

                    for (var elem in params) {

                        if (params.hasOwnProperty(elem)) {

                            // Заменяем шаблоны в сообщении
                            message = message.replace('{' + elem + '}', params[elem]);

                        }
                    }

                }

            } else {

                console.log('Expected params as "object", received "' + (typeof params) + '".');
            }

        }

        return message;
    }

};


YiiApp.tt = function (message, params) {

    params = params || [];

    var lang = $('html').attr('lang');

    YiiApp.ttData = {
        'params': {
            'lang': lang,
            'source_lang': 'en-US'
        },
        'messages': window.ttData
    };

    if (typeof YiiApp.ttData !== 'undefined') {

        if (lang != YiiApp.ttData.params.source_lang && message in YiiApp.ttData.messages) {

            var translation = YiiApp.ttData.messages[message];

            console.log('Found translation "' + message + '" => "' + translation + '".');

            return YiiApp.ttLib.processMessage(translation, params);

        } else {

            if (lang == YiiApp.ttData.params.source_lang) {
                console.log('Translation for "' + message + '" don\'t need as it already in the source language.');
            } else {
                console.log('Translation for "' + message + '" not found.');
            }

            return YiiApp.ttLib.processMessage(message, params);
        }

    } else {

        console.log('Can\'t found YiiApp.ttData...');

        return YiiApp.ttLib.processMessage(message, params);
    }

};

//console.log(YiiApp.tt('You must select {a} string', {'a': 'super'}));
//console.log(YiiApp.tt('There {n, plural, =0{are no cats} =1{is one cat} few{are few cats} other{are # cats}}', {n: 2}));
//console.log(YiiApp.tt('У меня есть {n, number, currency} в кармане!', [{value: 2134, currency: 'RUB'}]));
//console.log(YiiApp.tt('У меня есть {n, number, currency} в кармане!', [{value: 2134, currency: 'RUB'}]));

//console.log(YiiApp.tt('Translations'));