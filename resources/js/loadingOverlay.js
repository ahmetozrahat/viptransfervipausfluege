let loadingOverlay;

(function() {
    if (typeof(loadingOverlay) !== 'undefined') return;

    let lastSpinHandle = "";

    let heredoc = function(f) {
        return f.toString().match(/\/\*\s*([\s\S]*?)\s*\*\//m)[1];
    };
    let lut = [];
    for (let il = 0; il < 256; il++) { lut[il] = (il < 16 ? '0' : '') + (il).toString(16); }
    let uuid = function() {
        let d0 = Math.random() * 0xffffffff | 0;
        let d1 = Math.random() * 0xffffffff | 0;
        let d2 = Math.random() * 0xffffffff | 0;
        let d3 = Math.random() * 0xffffffff | 0;
        return lut[d0 & 0xff] + lut[d0 >> 8 & 0xff] + lut[d0 >> 16 & 0xff] + lut[d0 >> 24 & 0xff] + '-' +
            lut[d1 & 0xff] + lut[d1 >> 8 & 0xff] + '-' + lut[d1 >> 16 & 0x0f | 0x40] + lut[d1 >> 24 & 0xff] + '-' +
            lut[d2 & 0x3f | 0x80] + lut[d2 >> 8 & 0xff] + '-' + lut[d2 >> 16 & 0xff] + lut[d2 >> 24 & 0xff] +
            lut[d3 & 0xff] + lut[d3 >> 8 & 0xff] + lut[d3 >> 16 & 0xff] + lut[d3 >> 24 & 0xff];
    };
    let makeCRCTable = function() {
        let c;
        let crcTable = [];
        for (let n = 0; n < 256; n++) {
            c = n;
            for (let k = 0; k < 8; k++) {
                c = ((c & 1) ? (0xEDB88320 ^ (c >>> 1)) : (c >>> 1));
            }
            crcTable[n] = c;
        }
        return crcTable;
    }
    let crcTable = null;
    let crc32 = function(str) {
        if (!crcTable) crcTable = makeCRCTable();
        let crc = 0 ^ (-1);

        for (let i = 0; i < str.length; i++) {
            crc = (crc >>> 8) ^ crcTable[(crc ^ str.charCodeAt(i)) & 0xFF];
        }

        return (crc ^ (-1)) >>> 0;
    };

    let showTarget = function(selector) {

        let elem = document.querySelectorAll(selector);
        for (let i = 0; i < elem.length; i++) {
            elem[i].style.display = "block";
        }


    };

    let hideTarget = function(selector) {

        let elem = document.querySelectorAll(selector);
        for (let i = 0; i < elem.length; i++) {
            elem[i].style.display = "none";
        }

    };

    let appendHtmlToTarget = function(selector, html) {
        let elem = document.querySelectorAll(selector);
        for (let i = 0; i < elem.length; i++) {
            elem[i].insertAdjacentHTML('beforeend', html);
        }
    };


    let lo = (function() {

        let classNS = 'lo';
        let idNS = 'lo-' + uuid();

        let paramDefault = {
            'wrapClass': classNS + '-wrap',
            'spinClass': classNS + '-spin',
            'spinID': idNS,
            'target': 'body',
            'spinMinMS': 300,
            'spinWaitMS': 100,
        };


        let param2hash = function(param) {
            return crc32(param['wrapClass'] + param['spinClass'] + param['spinID']);
        };

        let cache = {};

        return {
            uuid: uuid,
            cache: function(param, createItemCallback) {
                let hash = param2hash(param);
                if (cache[hash]) return cache[hash];
                cache[hash] = createItemCallback();
                return cache[hash];
            },
            config2param: function(config) {
                let param = paramDefault;
                if ((typeof config === 'undefined') || (typeof config !== 'object')) {
                    return param;
                }
                for (let prop in param) {
                    if (typeof config[prop] !== 'undefined') {
                        param[prop] = config[prop];
                    }
                }
                return param;
            },
        };
    })();


    let invokeLoadingOverlay = function(config) {
        let param = lo.config2param(config);

        return lo.cache(param, function() {
            let target = '#' + param['spinID'];
            ////console.log('target...');
            ////console.debug(target);


            let cancelSpinnerOn = false;

            let spinnerStart;

            let cancelled_cb_proto = {
                'invoked': false,
                'cb': null,
            };
            let cancelled_cb_hash = {};
            let cancelled_status_hash = {};

            let cancelled_hash_proto = {
                'status': false,
                'cb_hash': {},
            };
            let cancelled_hash = {};

            let activateSpinner = function() {
               let spinWrap = document.getElementById(param['spinID']);
               if (!spinWrap) {
                  for (let csh in cancelled_status_hash) {
                     if (!cancelled_status_hash[csh]) {
                        cancelled_status_hash[csh] = true;
                     }
                  }
                  appendHtmlToTarget(param.target, heredoc(function() {
                          /*
                                         <div class="%wrapClass%" style="display:none; " id="%spinID%"></div>

                                      */
                      })
                      .replace(/%wrapClass%/g, param['wrapClass'])
                      .replace(/%spinID%/g, param['spinID'])
                  );
               }
                let mySpinHandle = uuid();
                lastSpinHandle = mySpinHandle;
                cancelSpinnerOn = false;
                cancelled_status_hash[mySpinHandle] = false;
                cancelled_hash[mySpinHandle] = cancelled_hash_proto;
                ////console.log('actvate: '+mySpinHandle);
                setTimeout(function() {
                    if (cancelled_status_hash[mySpinHandle] === true) {
                        return;
                    }
                    if (cancelSpinnerOn && (lastSpinHandle === mySpinHandle)) {
                        cancelSpinnerOn = false;
                        lastSpinHandle = null;
                        return false;
                    }
                    if (lastSpinHandle !== mySpinHandle) {
                        return false;
                    }
                    spinnerStart = Date.now();
                    showTarget(target);
                }, param.spinWaitMS);
                return mySpinHandle;
            };
            let spinMin = param.spinMinMS;
            let cancelSpinner = function cancelSpinnerCallee(spinHandle, cancelledCallback, cancelUUID) {
                //console.log("cancel: " + spinHandle);
                let cUUID;
                if (typeof cancelUUID === 'undefined') {
                    cUUID = lo.uuid();
                } else {
                    cUUID = cancelUUID;
                }
                if (cancelled_status_hash[spinHandle] === true) {
                    if (typeof cancelled_cb_hash[cUUID] !== 'undefined') {
                        if (!cancelled_cb_hash[cUUID].invoked) {
                            cancelled_cb_hash[cUUID].invoked = true;
                            cancelled_cb_hash[cUUID]();
                        }
                    }
                    return;
                }

                cancelled_cb_hash[cUUID] = cancelled_cb_proto;

                if (typeof cancelledCallback !== 'undefined') {
                    cancelled_cb_hash[cUUID].cb = cancelledCallback;
                }

                if (typeof cancelled_hash[spinHandle] === 'undefined') {
                    cancelled_hash[spinHandle] = cancelled_hash_proto;
                }
                cancelled_hash[spinHandle].cb_hash[cUUID] = cancelled_cb_hash[cUUID];

                cancelSpinnerOn = true;
                setTimeout(function() {
                    let spinTime = Date.now() - spinnerStart;
                    if (spinTime < spinMin) {
                        setTimeout(function() {
                            cancelSpinnerCallee(spinHandle, cancelledCallback, cUUID);
                        }, 10);
                    } else {

                        cancelled_status_hash[spinHandle] = true;
                        if (typeof cancelledCallback === 'function') {
                            //console.log('cb cancel normal');
                            cancelled_hash[spinHandle].cb_hash[cUUID].invoked = true;
                            cancelled_cb_hash[cUUID].invoked = true;
                            cancelledCallback();
                            for (let c in cancelled_hash[spinHandle].cb_hash) {
                                if (!cancelled_hash[spinHandle].cb_hash[c].invoked && (typeof cancelled_hash[spinHandle].cb_hash[c].cb === 'function')) {
                                    cancelled_hash[spinHandle].cb_hash[c].invoked = true;
                                    cancelled_hash[spinHandle].cb_hash[c].cb();
                                }
                            }
                        }
                        //console.log('cancel spinHandle ' + spinHandle + ' check if others are uncancelled');
                        for (let hh in cancelled_status_hash) {
                            if (!cancelled_status_hash[hh]) {
                                return;
                            }
                        }
                        hideTarget(target);
                    }
                }, 10);
            };

            //typeof cancelSpinnerCallee === 'undefined';
            //delete cancelSpinnerCallee;
            let obj = {
                cancel: cancelSpinner,
                activate: activateSpinner,
                cancelAll : function() {
                  let spinWrapElem = document.querySelectorAll('#'+param['spinID']);
                   for (let i = 0; i < spinWrapElem.length; i++) {
                      spinWrapElem[i].remove();
                      //console.log('removed');
                   }
                },
            };

            let targetElem = document.querySelectorAll(target);
            if (targetElem) {
                targetElem.forEach(function(elem) {
                    if (elem.classList.contains(param['class'])) {
                        return obj;
                    }
                });
            }

            appendHtmlToTarget(param.target, heredoc(function() {
                /*
                               <style>
                            .%wrapClass% {
                               position: fixed;
                               z-index: 999999;
                               margin: auto;
                               top: 0;
                               left: 0;
                               bottom: 0;
                               right: 0;

                            }

                            .%wrapClass%:before {
                               content: '';
                               display: block;
                               position: fixed;
                               top: 0;
                               left: 0;
                               width: 100%;
                               height: 100%;
                               background-color: rgba(255,255,255,0.6);
                            }

                            .%wrapClass%:not(:required) {
                               font: 0/0 a;
                               color: transparent;
                               text-shadow: none;
                               background-color: rgba(255, 255, 255, 0.5803921568627451);
                               border: 0;
                            }

                            .%wrapClass%:not(:required):after {
                               content: '';
                               display: block;
                               font-size: 10px;
                               width: 1em;
                               height: 1em;
                               position:fixed;
                               top:50%;
                               left:50%;
                               margin-top: -0.5em;
                               margin-left: -0.5em;
                               -webkit-animation: %spinClass% 1500ms infinite linear;
                               -moz-animation: %spinClass% 1500ms infinite linear;
                               -ms-animation: %spinClass% 1500ms infinite linear;
                               -o-animation: %spinClass% 1500ms infinite linear;
                               animation: %spinClass% 1500ms infinite linear;
                               border-radius: 0.5em;
                               -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
                               box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
                            }


                            @-webkit-keyframes %spinClass% {
                               0% {
                                  -webkit-transform: rotate(0deg);
                                  -moz-transform: rotate(0deg);
                                  -ms-transform: rotate(0deg);
                                  -o-transform: rotate(0deg);
                                  transform: rotate(0deg);
                               }
                               100% {
                                  -webkit-transform: rotate(360deg);
                                  -moz-transform: rotate(360deg);
                                  -ms-transform: rotate(360deg);
                                  -o-transform: rotate(360deg);
                                  transform: rotate(360deg);
                               }
                            }
                            @-moz-keyframes %spinClass% {
                               0% {
                                  -webkit-transform: rotate(0deg);
                                  -moz-transform: rotate(0deg);
                                  -ms-transform: rotate(0deg);
                                  -o-transform: rotate(0deg);
                                  transform: rotate(0deg);
                               }
                               100% {
                                  -webkit-transform: rotate(360deg);
                                  -moz-transform: rotate(360deg);
                                  -ms-transform: rotate(360deg);
                                  -o-transform: rotate(360deg);
                                  transform: rotate(360deg);
                               }
                            }
                            @-o-keyframes %spinClass% {
                               0% {
                                  -webkit-transform: rotate(0deg);
                                  -moz-transform: rotate(0deg);
                                  -ms-transform: rotate(0deg);
                                  -o-transform: rotate(0deg);
                                  transform: rotate(0deg);
                               }
                               100% {
                                  -webkit-transform: rotate(360deg);
                                  -moz-transform: rotate(360deg);
                                  -ms-transform: rotate(360deg);
                                  -o-transform: rotate(360deg);
                                  transform: rotate(360deg);
                               }
                            }
                            @keyframes %spinClass% {
                               0% {
                                  -webkit-transform: rotate(0deg);
                                  -moz-transform: rotate(0deg);
                                  -ms-transform: rotate(0deg);
                                  -o-transform: rotate(0deg);
                                  transform: rotate(0deg);
                               }
                               100% {
                                  -webkit-transform: rotate(360deg);
                                  -moz-transform: rotate(360deg);
                                  -ms-transform: rotate(360deg);
                                  -o-transform: rotate(360deg);
                                  transform: rotate(360deg);
                               }
                            }
                            </style>

                            */
            }).replace(/%wrapClass%/g, param['wrapClass']).replace(/%spinClass%/g, param['spinClass']));



            return obj;

        });
    };

    //loadingOverlay = invokeLoadingOverlay;
   function functionize( obj , func ) {
       let out = func;
       for( let i in obj ){ out[i] = obj[i]; }
       return out;
   }


    loadingOverlay = invokeLoadingOverlay();

    loadingOverlay = functionize( loadingOverlay , function(param){ return invokeLoadingOverlay(param); } );

})();
