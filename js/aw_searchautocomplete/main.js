/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/LICENSE-M1.txt
 *
 * @category   AW
 * @package    AW_Seacrhautocomplete
 * @copyright  Copyright (c) 2003-2010 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/LICENSE-M1.txt
 */

YAHOO.example.CustomFormatting = function(){
    var oDS = new YAHOO.util.ScriptNodeDataSource(installPath);

    oDS.responseSchema = {
        resultsList: 'ResultSet.Result',
        fields: ['content','url']
    };

    oDS.scriptCallbackParam = 'callback';


    var oAC = new YAHOO.widget.AutoComplete('myInput', 'myContainer', oDS);

    oAC.generateRequest = function(sQuery) {
        return '?q=' + sQuery +'&storeId='+storeId;
    };

    oAC.maxResultsDisplayed  = maxResultsDisplayed;
    oAC.resultTypeList = false;
    oAC.queryDelay = queryDelay;
    oAC.minQueryLength = 3;
    oAC.setHeader(defaultHeader);
    oAC.setFooter(defaultFooter);
    oAC.openInNewWindow = openInNewWindow;
    oAC.emptyText = emptyText;

    oAC.formatResult = function(oResultData, sQuery, sResultMatch) {
        this.sQuery = sQuery;
        return oResultData.content;
    };

    var validateForm = function() {
        return true;
    };

    oAC.itemSelectEvent.subscribe(function(sType, aArgs) {
        document.getElementById('myInput').value = this.sQuery;
        if(aArgs[0].openInNewWindow) {
            var win = window.open(aArgs[2]['url'], '_blank', '');
            win.focus();
        }
        else window.location = aArgs[2]['url'];
    });

    oAC.textboxFocusEvent.subscribe(function() {
        var oInput = document.getElementById('myInput');
        if(oInput.value == this.emptyText) oInput.value = '';
    });

    oAC.textboxBlurEvent.subscribe(function() {
        var oInput = document.getElementById('myInput');
        if(oInput.value == '') oInput.value = this.emptyText;
    });

    oAC.dataRequestEvent.subscribe(function() {
        var myInput=document.getElementById('myInput');
        myInput.style.backgroundImage = 'url("'+preloaderImage+'")';
        myInput.style.backgroundRepeat = 'no-repeat';
        myInput.style.backgroundPosition = 'right';
    });

    oAC.dataReturnEvent.subscribe(function() {
        var myInput=document.getElementById('myInput');
        myInput.style.backgroundImage = '';
    });

    oAC.dataErrorEvent.subscribe(function() {
        var myInput=document.getElementById('myInput');
        myInput.style.backgroundImage = '';
    });

    return {
        oDS: oDS,
        oAC: oAC,
        validateForm: validateForm
    }
};
