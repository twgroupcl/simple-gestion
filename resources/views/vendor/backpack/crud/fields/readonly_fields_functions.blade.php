<script>
    relationships = (...$selects) => {
        $selects.forEach(element => {
            element.attr('readonly', true).attr('disabled', '');
            element.parent().children('button[type="button"]').hide();
        });
    }
    simpleInput = (...args) => {
        args.forEach(element => {
            element.prop('readonly', true).click(function () { return false; });
        });
    }
    textareas = (...args) => {
        args.forEach(element => {
            element.prop('readonly', true)
        });
    }
    buttons = (...args) => {
        args.forEach(element => {
            element.remove()
        });
    }
    repeatables = (canAdd, ...args) => {
        args.forEach(element => {
            if (element.children('div[data-repeatable-identifier]').length > 0) {
                form = element.children('div[data-repeatable-identifier]')
                fields = form.find('.form-group')
                button = form.find('button')
                simpleInput(fields.find("input"))
                relationships(fields.find("select"))
                textareas(fields.find("textarea"))
                buttons(button)
            }
            element.find('.file_clear_button_repeatable').remove()
            if (!canAdd) {
                element.parent().parent().children('button').remove()
            }
        })
    }
    onlyAddInRepeatables = (...args) => {
        repeatables(true, ...args)
    }
    </script>