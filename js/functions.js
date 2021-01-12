// http://locutus.io/php/array/array_unique/
function array_unique(inputArr) {
  var key = ''
  var tmpArr2 = {}
  var val = ''
  var _arraySearch = function(needle, haystack) {
    var fkey = ''
    for (fkey in haystack) {
      if (haystack.hasOwnProperty(fkey)) {
        if ((haystack[fkey] + '') === (needle + '')) {
          return fkey
        }
      }
    }
    return false
  }
  for (key in inputArr) {
    if (inputArr.hasOwnProperty(key)) {
      val = inputArr[key]
      if (_arraySearch(val, tmpArr2) === false) {
        tmpArr2[key] = val
      }
    }
  }
  return tmpArr2
}




function do_when_exists(el, callback) {
  console.log("do_when_exists running");
  if (el.length > 0) {
    callback();
  } else {
    setTimeout(function() {
      do_when_exists(el, callback);
    }, 10);
  }
}




function is_wrapped(className) {

  var prevItemBottom;
  var isFlexed = false;

  jQuery('.' + className).each(function() {
    var currItem = jQuery(this);
    var currItemTop = currItem.offset().top;

    if (prevItemBottom && prevItemBottom <= currItemTop) {
      isFlexed = true;
    }
    prevItemBottom = currItemTop + jQuery(this).height();
  });

  return isFlexed;

}




String.prototype.replaceAll = function(str1, str2, ignore) {
  return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
}




function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds) {
      break;
    }
  }
}




function ucwords(str) {
  return str.replace(/\w\S*/g, function(txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}
