export function formatMoney (number, decimals, dec_point, thousands_sep) {
  decimals = typeof decimals !== 'undefined' ? decimals : 0;
  dec_point = typeof dec_point !== 'undefined' ? dec_point : ',';
  thousands_sep = typeof thousands_sep !== 'undefined' ? thousands_sep : '.';

  var n = !isFinite(+number) ? NaN : +number, 
      prec = !isFinite(+decimals) ? NaN : Math.abs(decimals),
      sep = thousands_sep,
      dec = dec_point,
      toFixedFix = function (n, prec) {
          // Fix for IE parseFloat(0.55).toFixed(0) = 0;
          var k = Math.pow(10, prec);
          return Math.round(n * k) / k;
      },
      s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  
  return s.join(dec);
}

export function hasAccess (access, userAccess) {
  access = typeof access !== 'undefined' ? access : '';
  userAccess = typeof userAccess !== 'undefined' ? userAccess : [];

  if (_.isArray(access)) {
    let allowed = 0;
    _.forEach(access, menuAccess => {
      if (_.includes(userAccess, menuAccess)) {
        allowed = allowed + 1;
      }
    })
    return allowed > 0;
  }
  return access === true ? true : _.includes(userAccess, access);
}

import i18n from '@/i18n.json'

export function lang (locale, fileName, keyName, params) {
  params = typeof params !== 'undefined' ? params : null;

  _.templateSettings.interpolate = /:([\w\d]*)/g;
  let compiled = _.template(i18n[locale][fileName][keyName]);
  return compiled(params);
}


export function formatDate (date) {
  // dateformat : dd MM yyyy
  var bln = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  var d = new Date(date || Date.now()),
    month = bln[d.getMonth()],
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (day.length < 2) day = '0' + day;

  return [day, month, year].join(' ');
}

export default {
  methods: {
    formatMoney,
    hasAccess,
    lang,
    formatDate
  }
}