/**
 * Created by abhinav on 13/2/16.
 */


(function ($) {
    'use strict';

    var _v = 'jqAjaxBrowser';

    $.fn.ajaxBrowser = function (options) {
        var parent = this;
        var $parent = $(this);
        var defaultOptions = {
            url: null
        };
        options = $.extend(defaultOptions, options);

        function init() {
            // Adding class to identify the application
            parent.addClass('ajaxBrowser dir');
            // Triggering initial directory
            parent.node().toggle();
            // Preventing text selection on double click
            $parent.mousedown(function (e) {
                e.preventDefault();
            });
        }

        $.fn.node = function () {
            var $node = this;
            var parentLevel = $node.parents('ul.tree').data('level');
            // For initial element
            if (typeof parentLevel == 'undefined') parentLevel = -1;

            console.log('parent', $node.parents('ul.tree').data('level'));

            var api = {
                toggle  : function () {
                    if ($node.data('isOpen') == true) {
                        $node.close();
                    } else {
                        $node.open();
                    }
                },
                open    : function () {
                    if ($node.data('isOpen') == true) return;
                    if ($node._hasIcon('loading') == true) return;
                    if ($node.hasClass('dir') == false) return;

                    console.log(_v, 'Opening tree');
                    var newLevel = parentLevel + 1;
                    var newElement = getNewTree(newLevel);
                    var path = $node.data('path');

                    console.log(_v, 'Parent: level', parentLevel, newLevel);
                    //console.log(_v, 'path', );
                    $node._setIcon('loading');

                    $.get(options.url, {path: path})
                        .done(function (resp) {
                            console.log(_v, 'Response', resp);
                            resp.forEach(function (obj) {
                                if (obj.type == 'file')
                                    newElement.append(getFileTemplate(obj, newLevel));
                                else
                                    newElement.append(getDirTemplate(obj, newLevel));
                            });
                        })
                        // Setting icon and mark as open
                        .done(function () {
                            $node._setIcon('icon-open');
                            $node.data('isOpen', true);
                            markOddEven();
                        })
                        // If failed
                        .fail(function () {
                            $node._setIcon('icon-close');
                        });

                    $node.append(newElement);

                },
                close   : function () {
                    $node.children('ul.tree').empty();
                    $node.data('isOpen', false);
                    $node._setIcon('icon-close');
                    markOddEven();
                },
                download: function () {
                    var path = $node.data('path');
                    console.log(_v, 'Download', path);
                    window.open(options.downloadUrl + '?file=' + path, "_self");
                },
                _setIcon: function (cls) {
                    var $e = $node.find('.item i.status').first();
                    if ($node.hasClass('ajaxBrowser')) return;
                    $e.removeAttr('class');
                    $e.addClass('status');
                    $e.addClass(cls);
                },
                _hasIcon: function (cls) {
                    var $e = $node.children('.item').children('i.status');
                    return $e.hasClass(cls);
                }
            };

            $.extend(this, api);

            return this;
        };

        // Binding events
        $(document).on('dblclick', '.ajaxBrowser li.dir .item', function (e) {
            $(this).parent().node().toggle();
        });

        $(document).on('click', '.ajaxBrowser li.dir .item i.status', function (e) {
            $(this).parents('li.dir').first().node().toggle();
        });

        $(document).on('dblclick', '.ajaxBrowser li.file', function (e) {
            $(this).node().download();
        });

        $(document).on('click', '.ajaxBrowser .item', function (e) {
            markOddEven();
            $(this).css('background-color', '#d9d7f7');
        });

        function getDirTemplate(obj, level) {
            return $('<li></li>')
                .addClass('node dir')
                .data('path', obj.relativePath)
                .append($('<div class="title item row"></div>')
                    .append($('<div class="col-md-7"></div>')
                        .css('padding-left', parseInt(level) * 20)
                        .append('<i class="status icon-close"></i> <i class="icon"></i> ' + obj.name)
                )
                    .append($('<div class="col-md-3 date-modified"></div>')
                        .append(obj.lastModified)
                )
                    .append($('<div class="col-md-2 size"></div>')
                        .append(obj.size)
                )
            );
        }

        function getFileTemplate(obj, level) {
            return $('<li></li>')
                .data('path', obj.relativePath)
                .addClass('node file')
                .append($('<div class="title item row"></div>')
                    .append($('<div class="col-md-7"></div>')
                        .css('padding-left', parseInt(level) * 20)
                        .append('<i class="status"></i> <i class="icon"></i> ' + obj.name)
                )
                    .append($('<div class="col-md-3 date-modified"></div>')
                        .append(obj.lastModified)
                )
                    .append($('<div class="col-md-2 size"></div>')
                        .append(obj.size)
                )
            );
        }

        function markOddEven() {
            $('.ajaxBrowser .item').css('background-color', '');
            $('.ajaxBrowser .item:even').css('background-color', '#F3F6FA');
        }

        function getNewTree(newLevel) {
            return $('<ul class="tree"></ul>').data('level', newLevel);
        }

        init();
    }

})(jQuery);
