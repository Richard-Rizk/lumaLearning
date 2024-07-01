function convertSqlDateToHtml(sqlDate) {
    // Convert SQL Server date to JavaScript Date object
    var jsDate = new Date(sqlDate);

    // Get date components
    var year = jsDate.getFullYear();
    var month = ('0' + (jsDate.getMonth() + 1)).slice(-2); // Months are zero-based
    var day = ('0' + jsDate.getDate()).slice(-2);

    // Format as "YYYY-MM-DD"
    var htmlDateFormat = year + '-' + month + '-' + day;

    return htmlDateFormat;
}