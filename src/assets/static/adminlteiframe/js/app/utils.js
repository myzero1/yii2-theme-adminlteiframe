
function findCsrf(){
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var csrf_param = $('meta[name=csrf-param]').attr('content');
    if (csrf_param && csrf_token) {
        return {
            "key": csrf_param,
            "val": csrf_token,
        };
    } else {
        return false;
    }
}