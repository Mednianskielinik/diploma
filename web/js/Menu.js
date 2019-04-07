!$(function () {

    function Menu() {
        this.$modal = $('#modalMenu');

        this.$gridPjax = $('#menuGridPjax');
        this.$formPjax = $('#formMenu');

        this.$addMenu = $('#addMenu');
    }

    Menu.prototype.addEventListener = function () {
        window.pjaxEndHideMenuModalAfterSave = true;
        var self = this;

        this.$addMenu.on('click', function (e) {
            e.preventDefault();
            $.pjax.reload({
                push: false,
                replace: false,
                url: $(this).attr('href'),
                container: '#formMenu',
                timeout: 7000
            });
            self.$modal.modal('show');
            return false;
        });

        this.$gridPjax.on('click', function (event) {
            var target = $(event.target);

            if (target.hasClass('update') || target.hasClass('fa-pencil')) {

                $.pjax.reload({
                    push: false,
                    replace: false,
                    url: target.attr('href'),
                    container: '#formMenu',
                    timeout: 7000
                });
                self.$modal.modal('show');
                return false;
            }
        });

        this.$formPjax.on('pjax:end', function (event, xhr, textStatus) {
            if (textStatus.type.toLowerCase() === 'post' && window.pjaxEndHideMenuModalAfterSave) {
                self.$modal.modal('hide');
                $.pjax.reload({
                    container: '#menuGridPjax',
                    timeout: 7000
                });
            }
            return false;
        });
    };

    Menu.prototype.init = function () {
        this.addEventListener();
    };

    (new Menu()).init();
});

