(function Controls(){

    var taskStorage = new TaskStorage();

    var clearResults = function(){
        //taskStorage.removeEvaluationsResults();
        taskStorage.restore();
    };


    var downloadResults = function(e){

        var scriptURL = (document.URL).replace('controls.html', 'download.php'),
            d = new Date(),
            timestamp = d.getFullYear() + '-' + (parseInt(d.getMonth()) + 1) + '-' + 
                d.getDate() + '_' + d.getHours() + '.' + d.getMinutes() + '.' + d.getSeconds();

        $.generateFile({
            filename	: 'evaluation_results_' + timestamp + '.txt',
            content		: JSON.stringify(taskStorage.getEvaluationResults()),
            script		: scriptURL
        });
        e.preventDefault();
    };


    (function init(){
        $('#clear_results').click(clearResults);
        $('#download_results').click(downloadResults);
    })();

})()
