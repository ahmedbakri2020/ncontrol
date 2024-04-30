$('document').ready(function () {

    $(".pagination a").trigger('click'); // When page is loaded we trigger a click
});

$('.pagination').on('click', 'a', function (e) {
    var page = this.id;
    var perPage = '50';
    var pagination = '';
    var data = {'perPage': perPage, 'page': page};
    $.ajax({
        url: 'ajax/pagination-news-img.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (response) {
           
            $('#search-list').html(response.newsList);
            if (page == 1)
                pagination += '<li class="disabled"><a href="#" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
            else
                pagination += '<li class=""><a href="#" id="1" aria-label="First"><span aria-hidden="true">First</span></a></li><li class=""><a href="#" id="' + (page - 1) + '" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';

            for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                // 	alert(i);
                if (i >= 1 && i <= response.numPage) {

                    if (i == page)
                        pagination += '<li class="active"><a href="#" id="' + i + '">' + i + '</a></li>';
                    else
                        pagination += '<li><a href="#" id="' + i + '">' + i + '</a></li>';

                } //end of if		  	
            } // end for loop

            if (page == response.numPage)
                pagination += '<li class="disabled"><a href="#"  aria-label="Next"><span aria-hidden="true">Next</span></a></li><li class="disabled"><a href="#" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';
            else
                pagination += '<li><a href="#" id="' + (parseInt(page) + 1) + '" aria-label="Next"><span aria-hidden="true">Next</span></a></li><li><a href="#" id="' + response.numPage + '" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';

            $('.pagination').html(pagination); // We update the pagination DIV

        }, // end of success

        error: function () { }

    });

    return false;

});



