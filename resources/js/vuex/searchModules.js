const requireModule = require.context("../../../Modules/", true, /state\.js$/); //extract js files inside modules folder
const modules = {};

requireModule.keys().forEach(fileName => {
  if (fileName === "./index.js") return; //reject the index.js file

  const moduleArray = fileName.split(/\//); //
  const moduleName=moduleArray[moduleArray.length-2]
  modules[moduleName] = {
    namespaced: true,
    ...requireModule(fileName).default
  }
});

export default modules;