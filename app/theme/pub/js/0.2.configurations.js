/**
 * Created by jrey on 15/02/2017.
 * 0.2.configuration.js
 */

// IMPORTANTE LA VARIABLE GLOBAL (YIIJS) DE JS QUE SE DECLARA EN MyController de YII

// block ui growlUI configuration
var growlUIconfig = {
    message: YIIJS.t['app.general.bienvenido'],
    fadeIn: 700,
    fadeOut: 700,
    timeout: 2000,
    showOverlay: false,
    centerY: false,
    css: {
        width: '30%',
        top: '10%',
        left: '',
        right: '10px',
        border: 'none',
        padding: '5px',
        backgroundColor: '#000',
        '-webkit-border-radius': '0px',
        '-moz-border-radius': '0px',
        opacity: 0.6,
        color: '#fff'
    }
};
var blockUIloadingConf ={
    message: YIIJS.t['app.general.cargando'],
    fadeIn: 700,
    fadeOut: 700,
    timeout: 2000,
    showOverlay: false,
    centerY: false,
    css: {
        width: '30%',
        top: '10%',
        left: '',
        right: '10px',
        border: 'none',
        padding: '5px',
        backgroundColor: '#000',
        '-webkit-border-radius': '0px',
        '-moz-border-radius': '0px',
        opacity: 0.6,
        color: '#fff'
    }
};
/**
 * FIN 0.2.configuration.js
 */