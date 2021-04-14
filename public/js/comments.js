    $('.toast').toast('show');
    //Tabs
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
    //Tabs --------

    // tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('.projectFile').change(function() {
        var pdf = `<img src="/images/pdf.png" class="img-fluid ml-auto mr-auto mb-2 ext_img" alt="">`;
        var wordDoc = `<img src="/images/microsoft-word-logo.svg" class="img-fluid ml-auto mr-auto mb-2 ext_img" alt="">`;
        var errDoc = `<img src="https://img.icons8.com/emoji/30/000000/question-mark-emoji.png"/>`;

        $('#fileContainer').removeClass('d-none'); // remove display none from the container to show the doc and image

        var extContainer = document.querySelector('.extImgContainer'); 
        var i = $(this).prev('docName').clone();
        var file = $('.projectFile')[0].files[0].name; // get file name
        var errText = 'Only Docx and Pdf is allowed';
        var ext = file.split('.').pop(); // get extension
        $('.docName').text(file);
        if(ext == 'docx') {
            extContainer.innerHTML = wordDoc; //   Appending image to the container
            $('#btn-comment').attr('disabled', false);
            $('.docName').removeClass('text-red-500');
        } else if (ext == 'pdf'){
            extContainer.innerHTML = pdf; //   Appending image to the container
            $('#btn-comment').attr('disabled', false);
            $('.docName').removeClass('text-red-500');
        } else {
            $('#btn-comment').attr('disabled', true);
            extContainer.innerHTML = errDoc;
            $('.docName').text(errText);
            $('.docName').addClass('text-red-500');
        }
    });

    $('#remove').on('click', 'span', function() {
        $('#fileContainer').addClass('d-none'); // remove display none from the container to show the doc and image
        $('#file').val('')
        console.log($('#file').val());
    })
