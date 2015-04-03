// JavaScript Document

// Define plugins here
// create an fn function for a loader...
$.fn.Loader = function () {
    var img = $('<img />', {
            src: document.cdn + 'loader.gif'
        }),
        span = $('<span />', {
            id: 'loader-span'
        });
    if (this.find('span#loader-span').length === 0) {
        var content = $(span).html(arguments[0] || '').append(img);

        // Content should be appended only into a div or a span
        if ($(this).is('div') || $(this).is('span')) {
            // Add content
            $(this).html(content);
        }

        // In case the parent is not visible, show it!
        if (!this.is(':visible')) {
            this.show();
        }
    }
    return this;
};
$.fn.RemoveLoader = function () {
    this.find('span#loader-span').fadeOut('fast', function () {
        this.remove();
    });
    return this;
};
// Handle calendar
(function () {
    var calendar = function (options) {
        this.options = $.extend({
            header: {
                left: 'prev,today,next ',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            defaultDate: new Date(),
            defaultView: 'month',
            eventStartEditable: true,
            eventDurationEditable: true,
            eventLimit: true, // allow "more" link when too many events
            eventDrop: drop
        }, options);
    }

    // Define a public function
    $.fn.gigacal = function (options) {
        // Keep track of the calendar
        var cal = this;
        // Allow for id's only
        if (!/^#/.test($(cal).selector)) {
            return;
        }
        if (!options) {
            options = {};
        }
        // Get HTML 5 defined options
        $.extend(options, $(cal).data('calendar') || {});

        // Bind the full calendar on the element
        $(cal).fullCalendar(new calendar(options).options);

        // Check for removal or addition of data sources on the calendar
        $(document).on('change', '[role=event-source]', function () {
            $(cal).fullCalendar($(this).is(':checked') ? 'addEventSource' : 'removeEventSource', $(this).data('source'));
        });
    }

    // Handle event dragging - drag stop
    function drop(event, delta, revertFunc) {
        // Get user's consent
        if (!confirm('Event "' + event.title + '" will start on ' + event.start.format())) {
            return revertFunc();
        }
        // Update the event now
        $.ajax({
            'type': 'patch',
            'url': event.resource,
            'data': delta._data,
            'success': function (resp) {
                if (!resp[0]) {
                    revertFunc();
                }
            },
            'error': function () {
                revertFunc();
            }
        });
    }
})(jQuery);

// Load stuff via ajax
$.fn.ajaxMagic = function () {
    $(this).each(function () {
        // Get the data
        $(this).load($(this).data('content') || null, function (resp) {
            // Run any after load here!
        });
    });
};

// Intelify datepicker on ranges
$.fn.datepickerRange = function () {
    var options = $.extend({
        'changeMonth': false,
        'numberOfMonths': 1,
        'addSliderAccess': true,
        'sliderAccessArgs': {touchonly: true}
    }, arguments[0] || {});

    this.each(function () {
        var data = $(this).data(),
            end = $(data.compliment);

        // Init a range date time picker
        $.timepicker.datetimeRange($(this), end, {
            minInterval: (1000 * 60 * 15), // 15 Minutes
            dateFormat: 'dd M yy',
            timeFormat: 'hh:mm TT z',
            start: options,  // start picker options
            end: options     // end picker options
        });
    });

};

// Handle auto-complete
(function ($) {
    $.fn.completes = function (options) {
        this.each(function () {
            $(this).autocomplete($.extend(options || {}, {
                'minLength': 2,
                'source': function (request, response) {
                    // $(this).data('source') || null + '?ommited=' + $(this).data('selected') || []
                    $.ajax({
                        'type': 'get',
                        'url': $(this.element).data('source') || null,
                        'data': $.extend({
                            'omitted': $(this.element).data('selected') || []

                        }, request),
                        'success': function (resp) {
                            response(resp);
                        },
                        'error': function () {
                            response([]);
                        }
                    });
                },
                'close': function (event, ui) {
                    // Reset the field
                    $(this).val(null);
                },
                'select': function (event, ui) {
                    // Get data and create a hidden input
                    var data = $(this).data(),
                        hiddenInput = $('<input>', {
                            'id': data.alt.substr(data.alt.indexOf('#') + 1),
                            'name': data.altName,
                            'value': ui.item.id,
                            'type': 'hidden'
                        }),
                        selected = data.selected || [];
                    // Add the selected value to the selected list
                    selected.push(ui.item.id);
                    $(this).data({selected: selected});
                    // Set value of the alt field to the id
                    if (data.multi || false) {
                        // Create multiple fields and add above oya field
                        $('<span>', {
                            'class': 'pg5lr pg3tb pl bgg2 crff br3 mg2b mg1r parent-oya',
                            'html': ui.item.value
                        }).append($('<a>', {
                            'class': 'mg10l',
                            'href': '#',
                            'html': '<i class="fa fa-10x fa-trash-o dismiss-oya" data-value="' + ui.item.id + '"></i>'
                        })).append(hiddenInput).insertBefore(this);
                    } else {
                        // Just add a single hidden field
                        // Check that the field is not already created on the form
                        if (!$(this).parents('form').find(data.alt).length) {
                            hiddenInput.insertAfter($(this));
                        } else {
                            $(this).parents('form').find(data.alt).val(ui.item.id);
                        }
                    }
                    // Fire a picked event!
                    $(document).trigger(data.event || 'picked' + '.autocomplete', $.extend(ui.item, {
                        'element': this
                    }));
                }
            }));
        });
    }

    // Remove from list - applies for multiple adding
    $(document).on('click', '.dismiss-oya', function () {
        var target = $(this).parents('.parent-oya'),
            autoField = target.siblings('input'),
            data = autoField.data('selected');

        // Remove the value from the selected list
        data.splice(data.indexOf($(this).data('value') || ''), 1);
        autoField.data({selected: data}).val(null);

        // Remove scheduler
        $('#scheduler-content #' + $(this).data('value') || '').remove();

        // Remove invite
        target.remove();

        // Get home before dawn!
        return false
    });

    // Bind on invite.autocomplete event to handle selected inviteee
    $(document).on('invite.autocomplete', function (e, invite) {
        var start = 'today',
            end = 'tomorrow';
        // Get the start and end dates for the event!
        // console.log($(invite.element).parents('form'));

        // Create a div with invitee's id; as id and add to form
        // Send an ajax request to fetch scheduler
        $('<div>', {
            'id': invite.id,
            'class': 'width-f pl pg5a bort bor1 borcdd'
        }).appendTo('#scheduler-content').load(encodeURI($('#scheduler-content').data('scheduler') + '?start=' + start + '&end=' + end + '&user=' + invite.id));
    });


})(jQuery);


// Set ajax global params
$.ajaxSetup({
    headers: {'X-XSRF-TOKEN': $('meta[name=_token]').attr('content')}
});

// Use a dedicated class - imager
$.fn.Imager = function () {
    $(document).on('change', this.selector, function () {
        var imager = $($(this).data('target')).Loader('Working, please wait!');
        for (var i = 0; i < this.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $('<img/>', {
                    'src': e.target.result
                });
                console.log(e.target);
                if (imager.children('img').length) {
                    imager.append(img);
                } else {
                    imager.html(img);
                }
            };
            reader.readAsDataURL(this.files.item(i));
        }
    });
    return $(this).parents('form') || this;
};

(function ($) {
    $(window).load(function () {

        //$.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default

        $(".custom_scrollbar").mCustomScrollbar({
            //setHeight:340,
            theme: "dark"
        });
    });
})(jQuery);

$(document).ready(function (e) {
    // cache the id
    var navbox = $('.nav-tabs');

    // activate tab on click
    navbox.on('click', 'a', function (e) {
        var $this = $(this);
        // prevent the Default behavior
        e.preventDefault();
        // send the hash to the address bar
        window.location.hash = $this.attr('href');
        // activate the clicked tab
        $this.tab('show');
    });

    // will show tab based on hash
    function refreshHash() {
        navbox.find('a[href="' + window.location.hash + '"]').tab('show');
    }

    // show tab if hash changes in address bar
    $(window).bind('hashchange', refreshHash);

    // read has from address bar and show it
    if (window.location.hash) {
        // show tab on load
        refreshHash();
    }
    $('a[href="#"]').click(function (e) {
        e.preventDefault();
    });

    $('#classroom-tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('.example').dataTable();
    $('#courses').dataTable({
        "paging": false,
        "ordering": false,
        "info": false,
        bFilter: false,
        bInfo: false, "info": false
    });
    $('.table-example').dataTable();
    $('.example-report').dataTable();

    $("[data-toggle=tooltip]").tooltip();

    $("[data-toggle=popover]").popover({
        trigger: 'focus'
    });


    $("body").click(function (event) {
        if ($("#calender").hasClass('active')) {
            $("#side_right_menu").addClass('hide').removeClass('show');
            $("#task_right_menu").addClass('show').removeClass('hide');
        } else {
            $("#side_right_menu").addClass('show').removeClass('hide');
            $("#task_right_menu").addClass('hide').removeClass('show');

        }
    });

    //var $photo_width = $(".photo-load-img").width();
    //var $photo_height = $(".photo-load-img").height();
    //if ($photo_width >= 1000) {
    //    $('.photo-modal-inner').css({"width": "1300px"});
    //} else {
    //
    //}

    $('.load-full-photo').click(function () {
        $('.photo-modal').addClass('show-content').removeClass('hide-content');
    });

    $('.close-full-photo').click(function () {
        $('.photo-modal').addClass('hide-content').removeClass('show-content').find('.photo-load-img').attr('src', '');
    });

    $(".delete-item").click(function () {
        swal({
            title: "Are you sure?",
            text: "You can still enable the item later!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Disable it!',
            closeOnConfirm: false
            //closeOnCancel: false
        }, function () {
            swal("Disabled!", "Your Item has been disabled!", "success");
        });
    });

    $(".load-single-chat").click(function(e){
        $this = $(this);

        $this.parents(".side-panel-chat-content").siblings(".single-chat-load").children(".single-chat").toggleClass('hide');
    });


    $(".remove-loaded-chat").click(function(e){
        $this = $(this);
        $this.parents(".single-chat").toggleClass('hide');
    });

    //$(".switch-mode").click(function(e){
    //    $this = $(this);
    //    if( $this.hasClass('active')){
    //        // do nothing
    //    }else{
    //        $this.addClass('active').siblings().removeClass('active');
    //        alert($this.parents(".chat-main-bar").sibling(".side-panel-chat-content").children(".chat-switch-content"))
    //            //.toggleClass('hide show');
    //    }
    //    //$this.toggleClass('active' , 'addOrRemove').parents(".chat-main-bar").sibling(".side-panel-chat-content").children(".chat-switch-content").toggleClass('hide');
    //});

    $(".class-member-moredetail").click(function (event) {
        $(".class-member-moredetail-show").modal();
        $(".evaluate-teacher").click(function (event) {
            $(".evaluate-teacher-show").modal();
        });
    });

    $(".new-schedule").click(function (event) {
        $(".new-schedule-show").modal();
    });

    $(".expand-more").click(function () {
        $(".updates-more").toggleClass('hide');
        $(".research-more").toggleClass('hide');
    });
    $("#assign-nav-answer").click(function () {
        //$(this).toggleClass('active').siblings().removeClass('active');
        //$(this).parents('.assignment-controls-div').children('.assignment-controls-show').toggleClass('hide');
        // $(this).parents('.assignment-controls-div').children(".clarification-controls-show").addClass('hide');
    });
    $("#assign-nav-clarification").click(function () {
        //$(this).toggleClass('active').siblings().removeClass('active');
        // $(this).parents('.assignment-controls-div').children('.clarification-controls-show').toggleClass('hide');
        // $(this).parents('.assignment-controls-div').children(".assignment-controls-show").addClass('hide');
    });
    $(".sticky_notice_title").click(function () {
        $(this).siblings('.zoomed_note').toggleClass('hide')
    });
    $(".hide-notice").click(function () {
        $(this).parents('.zoomed_note').toggleClass('hide')
    });

    $(".expand-plus").click(function () {
        $(this).parents('.expand-parent-div').children('.expand-plus-div').toggleClass('hide');

    });

    $(".user_menu_link").click(function () {
        $(this).parent('.user_menu_parent').children('.user_menu').toggleClass('hide');
    });
    $(".group-show-more").click(function () {
        alert
        $(this).parents('.individual-group-sibling1').siblings('.individual-group-sibling2').toggleClass('hide');
    });

    $(".expandm").click(function () {
        $(".research-more").toggleClass('hide');
    });

    $(".notes-post-type1").click(function () {
        $(".type-field").toggleClass('hide');
    });

    $(".notes-post-type2").click(function () {
        $(".type-upload").toggleClass('hide');
    });


    $(".user_link").click(function () {
        $(this).children('.user_menu').toggleClass('hide');
    });

    $(".group-show").click(function () {
        $(this).parents('.group-list').siblings('.indidual-show').toggleClass('hide');
    });

    $(".user_link_s").click(function () {
        $(this).siblings('.user_menu_s').toggleClass('hide');
    });

    $('.side-panel').click(function () {

        if ($("#side-panel-content").hasClass('show-content')) {
            $(".side-panel-content").addClass('hide-content').removeClass('show-content');
            $('body').css({"margin-left": "0%"});
        } else if ($("#side-panel-content").hasClass('hide-content')) {
            $(".side-panel-content").addClass('show-content').removeClass('hide-content').css({"margin-left": "-300px"});
            ;
            $('body').css({"margin-left": "300px"});
        }
    });

    $('.custom-textarea').wysihtml5();

    // Hide or show component
    $(document).on('change', 'input[data-toggle=flop]', function (e) {
        var data = $(this).data();
        if (data.type === 'hide') {
            $(data.target).addClass('hidden');
        } else {
            $(data.target).removeClass('hidden');
        }
    });

    // George signup scripts
    (function () {
        $('a.scrollable').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });

        $("label").click(function () {
            if ($(this).attr("tgt") != "") {
                //alert($(this).attr("tgt"));
                $("#" + $(this).attr("tgt")).click();
            }
        });
    })(jQuery);

    // Handle date issues
    $(function () {
        var eof = $('<div>', {
            'class': 'width-f pl',
            'id': 'eof'
        });

        $('.datepicker').datepicker();

        // Handle ranged dates - define the range role on the first element; then point the second element
        // using data-compliment="<id of end element>"
        $('input[role=range]').datepickerRange({
            'numberOfMonths': 1,
            'showButtonPanel': true
        });


        $('#gigacal').gigacal();

        // Post to-do subtask
        $('form[role=subtask]').on('submit', function (e) {
            $(this).ajaxSubmit({
                'dataType': 'html',
                'target': $(this).next('div'),
                'clearForm': true,
                'success': function (view) {
                    $(view).prependTo(this.target);
                }
            });
            return false;
        });

        // Complete (un-complete) a task
        $('input[data-toggle=task]').on('change', function (e) {
            $(this).parents('form').ajaxSubmit({
                'cache': false,
                'success': function (resp) {
                    if (resp.subtask) {
                        return;
                    }
                    // Get the to-do;
                    if (resp.complete) {
                        // Remove eof
                        if ($('#complete > #eof').length) {
                            $('#complete > #eof').remove();
                        }
                        $('#todo-' + resp.id).addClass('completed-tasks').appendTo('#complete');

                        // Is the original place empty?
                        if (!$('#' + resp.priority).children().length) {
                            $('#' + resp.priority).html(eof.clone().html('No ' + resp.priority + ' to-do'));
                        }
                    } else {
                        // Remove eof
                        if ($('#' + resp.priority + ' > #eof').length) {
                            $('#' + resp.priority + ' > #eof').remove();
                        }
                        $('#todo-' + resp.id).removeClass('completed-tasks').appendTo('#' + resp.priority);

                        // Is the original place empty?
                        if (!$('#complete').children().length) {
                            $('#complete').html(eof.clone().html('No complete to-do'));
                        }
                    }
                }
            });
        });
    });

    // Get all stuffs that require to get content from ajax request
    $('*[role=ajax]').ajaxMagic();

    // Handle adding a searchable entity
    $('*[role=oya]').completes();

    // Respond to an invite
    $(document).on('click', 'span[role=cal-invite]', function (e) {
        $.ajax({
            'type': 'post',
            'url': $(this).parent().data('target'),
            'data': $(this).data(),
            'that': this,
            'success': function (resp) {
                if (resp.status || false) {
                    if ($(this.that).parents('.cal-invite').siblings().length) {
                        $(this.that).parents('.cal-invite').remove();
                    } else {
                        $(this.that).parents('.cal-invites').remove();
                    }
                }
            }
        });
    });

    // Set imager on all file inputs
    $('input[type=file]').Imager();


    var tbl = $('#institution-admin').dataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "serverSide": true
    });
    //using js table plugin
    // $.table(tbl);


    /**
     * General post ajax
     */
    $(document).on('click', '.post', function () {


        var $this = $(this), form = $this.parents('form'), post = $("textarea[name=post]");
        var type = (form.attr('action').search("update") >= 0) ? [".update_count", ".updates_start"] : [".feed_count", ".feeds_start"], feedCount = $(type[0]);


        form.ajaxSubmit({

            'success': function (resp) {

                if (resp.status) {
                    var post = $(resp.post).hide();
                    $("#eof").remove();
                    $("#preview-upload").find('img').remove();
                    feedCount.html(parseInt(feedCount.text()) + 1);
                    form.parent().find(type[1]).prepend(post);
                   // $('.feeds_start').prepend(post);
                    post.slideDown();
                    form.trigger('reset');
                }

            }
        });

        return false;
    });


    /**
     * Handle ajax comments
     */
    $(document).on('click', '.comment', function () {

        var $this = $(this), form = $this.parents('form'), comment = form.find($("textarea[name=comment]"));

        if (!$.trim(comment.val())) {
            comment.focus();
            return false
        }


        $.ajax({
            'type': 'post',
            'url': form.attr('action'),
            'data': form.serialize(),
            'success': function (resp) {

                if (resp.status) {
                    var comment = $(resp.comment).hide();
                    form.find('.comment_start').prepend(comment);
                    comment.slideDown();
                    form.trigger('reset');
                }

            }
        });

        return false;
    });


    $(document).on('click', '.grading_mode', function () {
        $("#marks_out_of").is(':checked') ? $("#marks_out_of_value").slideDown(100).focus() : $("#marks_out_of_value").slideUp(100);
    });

    /**
     * Handle likes
     */
    $(document).on('click', '.like', function () {

        var $this = $(this);
        var lc = $this.find('.like_count');
        var count = parseInt(lc.text());

        $.ajax({
            'type': 'post',
            'url': $this.data('url'),
            'success': function (resp) {
                if (resp.status) {
                    $this.find('.like-type').text(resp.type);
                    lc.text(parseInt(count + resp.count));
                }
            }
        });

        return false;

    });

    $(document).on('click', '.gig', function (e) {

        e.stopImmediatePropagation();

        var $gig = $(this);

        $(".gig_content").html($gig.parents('._post_content').find('._share_content').html());

        $('.share').click(function (e) {
            e.stopImmediatePropagation();
            var $this = $(this), $gigPost = $("#gig_post");

            $.ajax({
                'type': 'post',
                'url': $gig.data('url'),
                'data' : {'post' : $gigPost.val()},
                'success': function (resp) {
                    if (resp.status) {
                        $('.modal').modal('hide',function(){
                            $gigPost.val("");
                        });

                    }
                }
            });



            return false;

        });

        return false;

    });


    $(document).on('click', '.load-full-photo', function (e) {
        e.stopImmediatePropagation();
        $photo_preview = $(this).removeData(); $('.photo-load-img').attr('src',$photo_preview.data('path'));
        var $photo_full = $("#photo_full");$photo_full.find('.photo_social').hide();$photo_full.data('url',$photo_preview.data('url'))

        $.ajax({
            'type': 'get',
            'url': $photo_preview.data('comments'),
            'success': function (resp) {
                if (resp.status) {
                    $photo_full.find('.feeds_start').html(resp.html);
                    $photo_full.find('.like_count').text((parseInt(resp.likes)));
                    $photo_full.find('.shares_count').text((parseInt(resp.shares)));
                    $photo_full.find('.comment_count').text(parseInt(resp.comments));
                    $photo_full.find('.caption').text(resp.description);
                    $photo_full.find('.photo_social').fadeIn();
                }
            }

        });


        $(document).on('click', '.photo_like', function (e) {
            e.stopImmediatePropagation();
            var $this = $(this);
            var $full = $('#photo_full');


            $.ajax({
                'type': 'post',
                'url': $photo_preview.data('like'),
                'success': function (resp) {
                    if (resp.status) {

                        var $like = $photo_full.find('.like_count');
                        var count = parseInt($like.text()) > 0 ? parseInt($like.text()) : 0;
                        $full.find('.like_count').text(Math.max(0, count + resp.count));
                        $photo_preview.parent().find('.like_count').text(Math.max(0, count + resp.count));
                    }
                }
            });

            return false;

        });


        $(document).on('click', '.photo_comment', function (e) {
            e.stopImmediatePropagation();
            var $this = $(this), form = $this.parents('form'), $full = $('#photo_full');
            var action = form.attr('action');
            var url = action.replace('photo_id', $photo_preview.data('url'));
            var $comment = form.find('textarea[name=comment]');
            if ($.trim($comment.val()) == '') {
                $comment.focus();
                return false;
            }


            $.ajax({
                'type': 'post',
                'url': url,
                'data': form.serialize(),
                'success': function (resp) {
                    if (resp.status) {
                        $('.feeds_start').prepend(resp.html);
                        var $comment = $full.find('.comment_count');
                        var count = parseInt($comment.text()) > 0 ? parseInt($comment.text()) : 0;
                        $full.find('.comment_count').text(Math.max(0, ++count));
                        $photo_preview.parent().find('.comment_count').text(Math.max(0, count));
                        form.trigger('reset');
                    }
                }

            });

            return false;

        });


        $(document).on('click','.pic_next',function(e){
            e.stopImmediatePropagation();
            $this = $(this);

            url = $this.data('url').replace('image_id', $photo_preview.data('url'));

            $.ajax({
                'type': 'get',
                'url': url,
                'success': function (resp) {
                    if (resp.status) {
                       console.log(resp);
                    }
                }

            });

            return false;

        });


        $(document).on('click', '.gig_photo', function (e) {

            e.stopImmediatePropagation();

            photo = $('<img>').attr('src',$photo_preview.data('path'));

            $(".gig_content").html(photo);


            $('.share').click(function (e) {
                e.stopImmediatePropagation();
                var $this = $(this), $gigPost = $("#gig_post");

                $.ajax({
                    'type': 'post',
                    'url': $photo_preview.data('gig'),
                    'data' : {'post' : $gigPost.val()},
                    'success': function (resp) {
                        if (resp.status) {
                            $('.modal').modal('hide');

                        }
                    }
                });

                $gigPost.val("");

                return false;

            });

            return false;

        });

        return false;

    });


    $(document).on('focus','.comment_box', function (e) {

        $commentBox = $(this);

        $commentBox.on('keydown',function(e){
            e.stopImmediatePropagation();

        if(e.which == 13)
        {
           var form = $commentBox.parents('form');

            if (!$.trim($commentBox.val())) {
                $commentBox.focus();
                return false
            }


            form.ajaxSubmit({
                'type': 'post',
                'success': function (resp) {

                    if (resp.status) {
                        var comment = $(resp.html).hide();
                        form.find('.comments_start').prepend(comment);
                        comment.slideDown();
                        form.trigger('reset');
                    }

                }
            });

            return false;

        }

        });



    })


    /**
     * Simple image preloader
     */
    $.fn.preload = function () {
        this.each(function () {
            $('<img/>')[0].src = this;
        });
    }

});
