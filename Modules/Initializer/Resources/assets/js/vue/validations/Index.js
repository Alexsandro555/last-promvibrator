class ValidationConvert {
    ruleValidations(params) {
        let result = [];
        for(let key in params) {
            if(key == 'required' && params[key] == true) {
                result.push(v => !!v || 'Обязательно для заполнения')
            }
            if(key == 'max') {
                result.push(v => {
                    if(v) {
                        return v.length <= params[key]|| 'Допустимо не более '+params[key]+ ' символов'
                    }
                    else {
                        return true;
                    }
                })
            }
            if(key == 'regex') {
                result.push(v => {
                    let regex = new RegExp(params[key]);
                    return regex.test(v) || 'Неверный формат'
                })
            }
        }
        return result;
    }
    count(arg) {
        for(let key in arg) {
            if(key == 'max') {
                return arg[key];
            }
        }
        return null;
    }
    required(arg) {
        for(let key in arg) {
            if(key == 'required' && arg[key] == true) {
                return true
            }
        }
        return null;
    }
}

export {ValidationConvert}