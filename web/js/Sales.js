!$(function () {

    function Sales() {
        this.$modal = $('#modalSales');

        this.$gridPjax = $('#salesGridPjax');
        this.$formPjax = $('#formSales');

        this.$addSales = $('#addSales');
    }

    Sales.prototype.addEventListener = function () {
        window.pjaxEndHideSalesModalAfterSave = true;
        var self = this;

        this.$addSales.on('click', function (e) {
            e.preventDefault();
            $.pjax.reload({
                push: false,
                replace: false,
                url: $(this).attr('href'),
                container: '#formSales',
                timeout: 7000
            });
            self.$modal.modal('show');
            return false;
        });

        this.$gridPjax.on('click', function (event) {
            var target = $(event.target);
            console.log(event);
            if (target.hasClass('update') || target.hasClass('fa-pencil')) {

                $.pjax.reload({
                    push: false,
                    replace: false,
                    url: target.attr('href'),
                    container: '#formSales',
                    timeout: 7000
                });
                self.$modal.modal('show');
                return false;
            }
        });

        this.$formPjax.on('pjax:end', function (event, xhr, textStatus) {
            if (textStatus.type.toLowerCase() === 'post' && window.pjaxEndHideSalesModalAfterSave) {
                self.$modal.modal('hide');
                $.pjax.reload({
                    container: '#salesGridPjax',
                    timeout: 7000
                });
            }
            return false;
        });
    };

    Sales.prototype.init = function () {
        this.addEventListener();
    };

    (new Sales()).init();
});

