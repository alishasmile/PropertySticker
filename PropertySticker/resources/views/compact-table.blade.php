<!--沒在用-->


@extends('head')

@section('title')

  <title>PropertySticker</title>

@endsection

@section('body')

<body>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                                
                <div class="fresh-table full-color-orange">
                
                    <div class="toolbar">
                        <button id="alertBtn" class="btn btn-default">Logout</button>
                    </div>
                    <p>{{ Session::get('user')}}</p>
                    <table id="fresh-table" class="table">
                        <thead>
                            <th data-field="id">ID</th>
                        	<th data-field="name" data-sortable="true">Name</th>
                        	<th data-field="salary" data-sortable="true">Salary</th>
                        	<th data-field="country" data-sortable="true">Country</th>
                        	<th data-field="city">City</th>
                        	<th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>19</td>
                                <td>Winifred Ryan</td>
                                <td>$64,436</td>
                                <td>Ireland</td>
                                <td>Ronciglione</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<div class="fixed-plugin" style="top: 300px">
    <div class="dropdown">
        <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title">Adjustments</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Full Background</p>
                    <div class="switch"
                        data-on-label="ON"
                        data-off-label="OFF">
                        <input type="checkbox" checked data-target="section-header" data-type="parallax"/>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Colors</p>
                    <div class="pull-right">
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange active" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Layouts</li>
            <li class="active">
                <a class="img-holder" href="compact-table.html">
                    <img src="{{URL::asset('img/compact.jpg')}}">
                    <h5>Compact Table</h5>
                </a>
            </li>
            <li>
                <a class="img-holder" href="full-screen-table.html">
                    <img src="{{URL::asset('img/full.jpg')}}">
                    <h5>Full Screen Table</h5>
                </a>
            </li>
        </ul>
    </div>
</div>

</body>

    <script type="text/javascript" src="{{URL::asset('js/jquery-1.11.2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap-table.js')}}"></script>
    <script type="text/javascript">

        function myReady(){
            substitution();
            setPageButton();
        }

        function sendPage($page){

            $.ajax({
                url: '{{URL::asset('/getpage')}}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    page: $page
                },
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    setPageButton();
                    console.log(response['items']);
                }
            });
        }

        function setPageButton(){
            $(".page-number").each(function(){
                //alert($(this).text());
                jQuery("a",this).attr("onclick","sendPage("+$(this).text()+");");
            });
        }

        function substitution(){
            $big = $("div.fixed-table-pagination" );
            $big.find("span.page-list").css('display', '');
            $big.find("div.pull-right.pagination").css('display', '');
        }
        
        

        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'),
            full_screen = false;

        $().ready(function(){
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                pageSize: 8,
                pageList: [8,10,25,50,100],

                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });



            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });



            $alertBtn.click(function () {//logout
                document.location.href="{{URL::asset('/logout')}}";
            });

            myReady();


        });


        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        }

        current_color = "orange";
        full_color = true;

        $().ready(function(){
            $fresh_table = $('.fresh-table');
            
            if($('.switch').length != 0){
                 $('.switch')['bootstrapSwitch']();
            }
            
            $('.fixed-plugin a').click(function(event){
              // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if($(this).hasClass('switch-trigger')){
                    if(event.stopPropagation){
                        event.stopPropagation();
                    }
                    else if(window.event){
                       window.event.cancelBubble = true;
                    }     
                }                          
            });
            
            $('.fixed-plugin .badge').click(function(){
               
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                 
                var new_color = $(this).data('color');
            
                $fresh_table.fadeOut('fast', function(){
                    if(full_color){
                        $fresh_table.removeClass("full-color-" + current_color).addClass("full-color-" + new_color);
                    } else {
                        $fresh_table.removeClass("toolbar-color-" + current_color).addClass("toolbar-color-" + new_color);
                    }  
                    
                    current_color = new_color;    
                    $fresh_table.fadeIn('fast');     
                });
            }); 
            
            $('.switch input').change(function(){
                $input = $(this);
                target = $input.data('target');
                type = $input.data('type');
            
                $fresh_table.fadeOut('fast', function(){
                    
                    if($input.is(':checked')){       
                        $fresh_table.removeClass("toolbar-color-" + current_color).addClass("full-color-" + current_color);
                        full_color = true;
                    } else {
                        $fresh_table.removeClass("full-color-" + current_color).addClass("toolbar-color-" + current_color);
                        full_color = false;
                    }    
               
                    $fresh_table.fadeIn('fast');     
                });        
            });
        });


        !function ($) {
          "use strict";

          $.fn['bootstrapSwitch'] = function (method) {
            var methods = {
              init: function () {
                return this.each(function () {
                    var $element = $(this)
                      , $div
                      , $switchLeft
                      , $switchRight
                      , $label
                      , myClasses = ""
                      , classes = $element.attr('class')
                      , color
                      , moving
                      , onLabel = "ON"
                      , offLabel = "OFF"
                      , icon = false;

                    $.each(['switch-mini', 'switch-small', 'switch-large'], function (i, el) {
                      if (classes.indexOf(el) >= 0)
                        myClasses = el;
                    });

                    $element.addClass('has-switch');

                    if ($element.data('on') !== undefined)
                      color = "switch-" + $element.data('on');

                    if ($element.data('on-label') !== undefined)
                      onLabel = $element.data('on-label');

                    if ($element.data('off-label') !== undefined)
                      offLabel = $element.data('off-label');

                    if ($element.data('icon') !== undefined)
                      icon = $element.data('icon');

                    $switchLeft = $('<span>')
                      .addClass("switch-left")
                      .addClass(myClasses)
                      .addClass(color)
                      .html(onLabel);

                    color = '';
                    if ($element.data('off') !== undefined)
                      color = "switch-" + $element.data('off');

                    $switchRight = $('<span>')
                      .addClass("switch-right")
                      .addClass(myClasses)
                      .addClass(color)
                      .html(offLabel);

                    $label = $('<label>')
                      .html("&nbsp;")
                      .addClass(myClasses)
                      .attr('for', $element.find('input').attr('id'));

                    if (icon) {
                      $label.html('<i class="' + icon + '"></i>');
                    }

                    $div = $element.find(':checkbox').wrap($('<div>')).parent().data('animated', false);

                    if ($element.data('animated') !== false)
                      $div.addClass('switch-animate').data('animated', true);

                    $div
                      .append($switchLeft)
                      .append($label)
                      .append($switchRight);

                    $element.find('>div').addClass(
                      $element.find('input').is(':checked') ? 'switch-on' : 'switch-off'
                    );

                    if ($element.find('input').is(':disabled'))
                      $(this).addClass('deactivate');

                    var changeStatus = function ($this) {
                      $this.siblings('label').trigger('mousedown').trigger('mouseup').trigger('click');
                    };

                    $element.on('keydown', function (e) {
                      if (e.keyCode === 32) {
                        e.stopImmediatePropagation();
                        e.preventDefault();
                        changeStatus($(e.target).find('span:first'));
                      }
                    });

                    $switchLeft.on('click', function (e) {
                      changeStatus($(this));
                    });

                    $switchRight.on('click', function (e) {
                      changeStatus($(this));
                    });

                    $element.find('input').on('change', function (e) {
                      var $this = $(this)
                        , $element = $this.parent()
                        , thisState = $this.is(':checked')
                        , state = $element.is('.switch-off');

                      e.preventDefault();

                      $element.css('left', '');

                      if (state === thisState) {

                        if (thisState)
                          $element.removeClass('switch-off').addClass('switch-on');
                        else $element.removeClass('switch-on').addClass('switch-off');

                        if ($element.data('animated') !== false)
                          $element.addClass("switch-animate");

                        $element.parent().trigger('switch-change', {'el': $this, 'value': thisState})
                      }
                    });

                    $element.find('label').on('mousedown touchstart', function (e) {
                      var $this = $(this);
                      moving = false;

                      e.preventDefault();
                      e.stopImmediatePropagation();

                      $this.closest('div').removeClass('switch-animate');

                      if ($this.closest('.has-switch').is('.deactivate'))
                        $this.unbind('click');
                      else {
                        $this.on('mousemove touchmove', function (e) {
                          var $element = $(this).closest('.switch')
                            , relativeX = (e.pageX || e.originalEvent.targetTouches[0].pageX) - $element.offset().left
                            , percent = (relativeX / $element.width()) * 100
                            , left = 25
                            , right = 75;

                          moving = true;

                          if (percent < left)
                            percent = left;
                          else if (percent > right)
                            percent = right;

                          $element.find('>div').css('left', (percent - right) + "%")
                        });

                        $this.on('click touchend', function (e) {
                          var $this = $(this)
                            , $target = $(e.target)
                            , $myCheckBox = $target.siblings('input');

                          e.stopImmediatePropagation();
                          e.preventDefault();

                          $this.unbind('mouseleave');

                          if (moving)
                            $myCheckBox.prop('checked', !(parseInt($this.parent().css('left')) < -25));
                          else $myCheckBox.prop("checked", !$myCheckBox.is(":checked"));

                          moving = false;
                          $myCheckBox.trigger('change');
                        });

                        $this.on('mouseleave', function (e) {
                          var $this = $(this)
                            , $myCheckBox = $this.siblings('input');

                          e.preventDefault();
                          e.stopImmediatePropagation();

                          $this.unbind('mouseleave');
                          $this.trigger('mouseup');

                          $myCheckBox.prop('checked', !(parseInt($this.parent().css('left')) < -25)).trigger('change');
                        });

                        $this.on('mouseup', function (e) {
                          e.stopImmediatePropagation();
                          e.preventDefault();

                          $(this).unbind('mousemove');
                        });
                      }
                    });
                  }
                );
              },
              toggleActivation: function () {
                $(this).toggleClass('deactivate');
              },
              isActive: function () {
                return !$(this).hasClass('deactivate');
              },
              setActive: function (active) {
                if (active)
                  $(this).removeClass('deactivate');
                else $(this).addClass('deactivate');
              },
              toggleState: function (skipOnChange) {
                var $input = $(this).find('input:checkbox');
                $input.prop('checked', !$input.is(':checked')).trigger('change', skipOnChange);
              },
              setState: function (value, skipOnChange) {
                $(this).find('input:checkbox').prop('checked', value).trigger('change', skipOnChange);
              },
              status: function () {
                return $(this).find('input:checkbox').is(':checked');
              },
              destroy: function () {
                var $div = $(this).find('div')
                  , $checkbox;

                $div.find(':not(input:checkbox)').remove();

                $checkbox = $div.children();
                $checkbox.unwrap().unwrap();

                $checkbox.unbind('change');

                return $checkbox;
              }
            };

            if (methods[method])
              return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            else if (typeof method === 'object' || !method)
              return methods.init.apply(this, arguments);
            else
              $.error('Method ' + method + ' does not exist!');
          };
        }(jQuery);

    </script>

</html>
@endsection