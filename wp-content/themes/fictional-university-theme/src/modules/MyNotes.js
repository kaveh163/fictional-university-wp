import $ from 'jquery'
class MyNotes {
    constructor() {
        this.events();
    }
    events() {
        $('#my-notes').on('click', '.delete-note', this.deleteNote.bind(this));
        $('#my-notes').on('click', '.edit-note', this.editNote.bind(this));
        $('#my-notes').on('click', '.update-note', this.updateNote.bind(this));
        $('.submit-note').on('click', this.createNote.bind(this));
    }
    // Methods will go here
    editNote(e) {
        let thisNote = $(e.target).parents('li');
        if(thisNote.data("state") == "editable") {
            this.makeNoteReadOnly(thisNote);
        } else {
            this.makeNoteEditable(thisNote);
        }
    }
    makeNoteEditable(thisNote) {
        thisNote.find('.edit-note').html('<i class="fa fa-times" area-hidden="true"></i>Cancel');
        thisNote.find('.note-title-field, .note-body-field').removeAttr('readonly').addClass('note-active-field');
        thisNote.find('.update-note').addClass('update-note--visible');
        thisNote.data('state', 'editable');
    }
    makeNoteReadOnly(thisNote) {
        thisNote.find('.edit-note').html('<i class="fa fa-pencil" area-hidden="true"></i>Edit');
        thisNote.find('.note-title-field, .note-body-field').attr('readonly','readonly').removeClass('note-active-field');
        thisNote.find('.update-note').removeClass('update-note--visible');
        thisNote.data('state', 'cancel');
    }
    deleteNote(e) {
        let thisNote = $(e.target).parents('li');
        //we should tell wordpress that we are logged in and have permission to do that
        // Nonce stands for "Number used once" or "Number once"
        // whenever we successfully log in to our wordpress account, wordpress creates a Nonce.
        $.ajax({
            //beforeSend: A pre-request callback function that can be used to modify the jqXHR object.
            //Use this to set custom headers
            //jqXHR has a setHeader method called setRequestHeader
            beforeSend: (xhr) => {
                // wordpress looks for 'X-WP-Nonce'
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce)
            },
            url:universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'DELETE',
            success: (response) => {
                thisNote.slideUp();
                console.log("Congrats");
                console.log(response);
                if(response.userNoteCount < 5) {
                    $('.note-limit-message').removeClass('active');
                }
                //window.location.href = universityData.root_url + '/my-notes';
            },
            error: (response) => {
                console.log("Sorry");
                console.log(response);
            }
        })
    }
    updateNote(e) {
        let thisNote = $(e.target).parents('li');
        let ourUpdatedPost = {
            "title": thisNote.find(".note-title-field").val(),
            "content": thisNote.find(".note-body-field").val()
        }
        //we should tell wordpress that we are logged in and have permission to do that
        // Nonce stands for "Number used once" or "Number once"
        // whenever we successfully log in to our wordpress account, wordpress creates a Nonce.
        $.ajax({
            //beforeSend: A pre-request callback function that can be used to modify the jqXHR object.
            //Use this to set custom headers
            //jqXHR has a setHeader method called setRequestHeader
            beforeSend: (xhr) => {
                // wordpress looks for 'X-WP-Nonce'
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce)
            },
            url:universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'POST',
            data: ourUpdatedPost,
            success: (response) => {
                this.makeNoteReadOnly(thisNote);
                console.log("Congrats");
                console.log(response);
                //window.location.href = universityData.root_url + '/my-notes';
            },
            error: (response) => {
                console.log("Sorry");
                console.log(response);
            }
        })
    }
    createNote(e) {
       
        let ourNewPost = {
            "title": $('.new-note-title').val(),
            "content": $('.new-note-body').val(),
            // default status for creating in restapi is 'draft'.
            // below code doesn't effect the status, since the status is set in backend(function.php)
            "status": 'publish'
        }
        //we should tell wordpress that we are logged in and have permission to do that
        // Nonce stands for "Number used once" or "Number once"
        // whenever we successfully log in to our wordpress account, wordpress creates a Nonce.
        $.ajax({
            //beforeSend: A pre-request callback function that can be used to modify the jqXHR object.
            //Use this to set custom headers
            //jqXHR has a setHeader method called setRequestHeader
            beforeSend: (xhr) => {
                // wordpress looks for 'X-WP-Nonce'
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce)
            },
            url:universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            success: (response) => {
                // response contains the new added post object.
                $('.new-note-title, .new-note-body').val('');
                $(`
                <li data-id="${response.id}">
                    <input readonly class="note-title-field" type="text" value="${response.title.raw}">
                    <span class="edit-note"><i class="fa fa-pencil" area-hidden="true"></i>Edit</span>
                    <span class="delete-note"><i class="fa fa-trash-o" area-hidden="true"></i>Delete</span>
                    <textarea readonly class="note-body-field" name="" id="" cols="30" rows="10">${response.content.raw}</textarea>
                    <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" area-hidden="true"></i>Save</span>
                </li>
                `).prependTo('#my-notes').hide().slideDown();
                console.log("Congrats");
                console.log(response);
                //window.location.href = universityData.root_url + '/my-notes';
            },
            error: (response) => {
                if(response.responseText == 'You have reached your note limit.') {
                    $('.note-limit-message').addClass('active');
                }
                console.log("Sorry");
                console.log(response);
            }
        })
    }
}
export default MyNotes;