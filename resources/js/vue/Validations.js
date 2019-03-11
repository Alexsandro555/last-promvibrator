class ValidationConvert {
  ruleValidations(params) {
    // описание всех правил валидации
    let result = [];
    for(let key in params) {
      if(key == 'required' && params[key] == true) {
        result.push(v => !!v || 'Обязательно для заполнения')
      }
      if (key == 'selected' && params[key] == true) {
        result.push(v => !!v || 'Необходимо выбрать значение')
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
          return regex.test(v) || 'Допустимы только цифры'
        })
      }
    }
    return result;
  }
  count(arg) {
    // это уже не валидация а максимальное количество символов
    for(let key in arg) {
      if(key == 'max') {
        return arg[key];
      }
    }
    return null;
  }
  required(arg) {
    // пометка поля ввода * - как обязательного для заполнения
    for(let key in arg) {
      if(key == 'required' && arg[key] == true) {
        return true
      }
    }
    return null;
  }
}

export {ValidationConvert}