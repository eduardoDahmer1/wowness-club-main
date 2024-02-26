<script>
    function renderInputDate() {
        'use strict';
        $('[data-toggle="flatpickr"]').each(function () {
        var element = $(this);
        var options = {
            mode: void 0 !== element.data('flatpickr-mode') ? element.data('flatpickr-mode') : 'single',
            altInput: void 0 !== element.data('flatpickr-alt-input') ? element.data('flatpickr-alt-input') : true,
            altFormat: void 0 !== element.data('flatpickr-alt-format') ? element.data('flatpickr-alt-format') : 'F j, Y',
            dateFormat: void 0 !== element.data('flatpickr-date-format') ? element.data('flatpickr-date-format') : 'Y-m-d',
            wrap: void 0 !== element.data('flatpickr-wrap') ? element.data('flatpickr-wrap') : false,
            inline: void 0 !== element.data('flatpickr-inline') ? element.data('flatpickr-inline') : false,
            static: void 0 !== element.data('flatpickr-static') ? element.data('flatpickr-static') : false,
            minDate: void 0 !== element.data('flatpickr-min-date') ? element.data('flatpickr-min-date') : null,
            enableTime: void 0 !== element.data('flatpickr-enable-time') ? element.data('flatpickr-enable-time') : false,
            noCalendar: void 0 !== element.data('flatpickr-no-calendar') ? element.data('flatpickr-no-calendar') : false,
            appendTo: void 0 !== element.data('flatpickr-append-to') ? document.querySelector(element.data('flatpickr-append-to')) : undefined,
            onChange: function onChange(selectedDates, dateStr) {
            if (options.wrap) {
                element.find('[data-toggle]').text(dateStr);
            }
            }
        };
        element.flatpickr(options);
        });
    }
    function handleRemoveDate(type, recurring){
            if(type == 1 && recurring == 3 || type == 1 && recurring == 2 ){
                $('input[id=end]').removeAttr('name', '');
                $('input[id=end_recurrence]').attr('name', 'end');
            }else{
                $('input[id=end]').attr('name','end')
                $('input[id=end_recurrence]').removeAttr('name', ''); 
            }
    }
 function handleEndRecurrenceDate(type, recurring){
        var inputStart = $('#start')
        handleRemoveDate(type, recurring)
       const options = {
            
            altInput: void 0 !== inputStart.data('flatpickr-alt-input') ? inputStart.data('flatpickr-alt-input') : true,
            altFormat: void 0 !== inputStart.data('flatpickr-alt-format') ? inputStart.data('flatpickr-alt-format') : 'F j, Y',
            dateFormat: void 0 !== inputStart.data('flatpickr-date-format') ? inputStart.data('flatpickr-date-format') : 'Y-m-d',
            wrap: void 0 !== inputStart.data('flatpickr-wrap') ? inputStart.data('flatpickr-wrap') : false,
            inline: void 0 !== inputStart.data('flatpickr-inline') ? inputStart.data('flatpickr-inline') : false,
            static: void 0 !== inputStart.data('flatpickr-static') ? inputStart.data('flatpickr-static') : false,
            minDate: void 0 !== inputStart.data('flatpickr-min-date') ? inputStart.data('flatpickr-min-date') : null,
            enableTime: void 0 !== inputStart.data('flatpickr-enable-time') ? inputStart.data('flatpickr-enable-time') : false,
            noCalendar: void 0 !== inputStart.data('flatpickr-no-calendar') ? inputStart.data('flatpickr-no-calendar') : false,
            appendTo: void 0 !== inputStart.data('flatpickr-append-to') ? document.querySelector(inputStart.data('flatpickr-append-to')) : undefined,
            onChange : (i, d) => {
                handleRemoveDate(type, recurring)
            }
        }       
        flatpickr('#start', options)
    } 
    
    $('#policy').on('change', function () {
        if ($(this).val() == "custom") {
            $('#text-policy').attr('readonly', false)
            $('#text-policy').attr('required', true)
            $('#text-policy').text('')
            $('#text-policy').attr('placeholder', 'Do you offer alternative cancellation OR rescheduling options? Please describe clearly the terms here.')
            return
        }

        $('#text-policy').attr('required', false)
        $('#text-policy').attr('readonly', true)
        $('#text-policy').text($(this).val())
    })

    function toggleElements(typeOption) {
        var isType2 = typeOption == 2
        $('.recurring').toggle(!isType2)
        // $('.start, .end, .recurring').toggle(!isType2)
        // $('.start :input, .end :input, .recurring :input').prop('disabled', isType2)
        $('.alert-date').toggleClass('d-none', !isType2)
        if(isType2) {
            $('.qty').val(1).css({
                'color': '#0000',
                'pointer-events': 'none',
                'background-color': '#e9ecef',
            })
        } else {
            $('.qty').css({
                'color': '#495057',
                'pointer-events': 'all',
                'background-color': '#fff',
            })
        }
    }

    const updateRequiredCheckbox = (checkboxes) => {
        checkboxes.some(box => box.checked) 
            ? checkboxes[0].removeAttribute('required') 
            : checkboxes[0].setAttribute('required', 'required');
    };

    const handleWeekDayValidation = (recurring, type) => {
        const checkboxes = Array.from(document.querySelector('.checkbox-repeat').children).filter(elem => elem.tagName.toLowerCase() !== 'label');
        const form = document.getElementById('serviceForm');
        
        if (recurring == 3 && type == 1) {
            updateRequiredCheckbox(checkboxes); // first execution
            
            checkboxes.forEach(elem => {
                elem.addEventListener('change', () => {
                    updateRequiredCheckbox(checkboxes);
                });
            });
        } else {
            checkboxes[0].removeAttribute('required');
        }
    }

    function toggleRecurrence(typeOption, selectedOption, customRecurrence) {
        var isIndividual = typeOption == 2;
        var isEveryWeek = selectedOption == 3;
        var isRetreat = typeOption == 4;
        var isCourse = typeOption == 3;

        $('.repeat').toggleClass('d-none', !isEveryWeek || isRetreat || isCourse || isIndividual);

        if(typeOption == 1 && selectedOption == 3 || typeOption == 1 && selectedOption == 2 ){
            $('.endRepeat').show();
            $('input[id=end_recurrence').removeAttr('disabled');
            $('input[id=end_recurrence').next().removeAttr('disabled');
            $('input[id=end').attr('disabled', 'disabled');
            $('input[id=end').next().attr('disabled', 'disabled');
            $('#end_recurrence').show();
            $('#end').hide();
            $('#end').removeAttr('name', '');
            $('#end_recurrence').attr('name', 'end');
        }else{
            $('.endRepeat').hide();
            $('input[id=end').removeAttr('disabled');
            $('input[id=end').next().removeAttr('disabled');
            $('input[id=end_recurrence').attr('disabled', 'disabled')
            $('input[id=end_recurrence').next().attr('disabled', 'disabled')
            $('#end_recurrence').hide();
            $('#end').show();
            $('#end').attr('name','end')
            $('#end_recurrence').removeAttr('name', ''); 
        }
    
        if (typeOption == 1 && selectedOption == 6 || typeOption == 3 && customRecurrence == 6 || typeOption == 4 && customRecurrence == 6){ 
            $('.dateRecurrenceDiv').show();
        } else {
            $('.dateRecurrenceDiv').hide();
        } 
    
        if(typeOption == 3 || typeOption == 4){
            $('#recurring_div').addClass('d-none');
            $('#recurring').prop('disabled', true);        
            $('#recurring_custom_div').removeClass('d-none');
            $('#recurring_custom').prop('disabled', false)
        }else{
            $('#recurring_div').removeClass('d-none');
            $('#recurring').prop('disabled', false);        
            $('#recurring_custom_div').addClass('d-none');
            $('#recurring_custom').prop('disabled', true)
        }
    }

    //Creates an array with all categories and subcategories
    let checksCategories = Array.from(document.querySelectorAll('.check-categories'))

    //It just checks if there is any category html element so it doesn't show error in the console on other pages
    if (checksCategories.length > 0) {

        //Adds an open and close event to the category selection box when clicking on the "add category" button
        document.querySelector("#open-list-cat").addEventListener('click', () => {
            document.querySelector('.list-categ').classList.toggle('show-list');
            event.target.classList.toggle('state-list-open');
        })

        //Function to be executed when the value changes in the selected elements (checksCategories)
        const handleAddArrayCat = (event) => {
            ArrayCat()
        }

        //Function to remove a selected category
        const handleRmCatList = event => {
            let inputRef = document.querySelector(`#${event.target.getAttribute('data-handle-rm-check')}`);
            //Change the value of the checkbox to false
            inputRef.checked = false
            //Regenerates array of selected categories
            ArrayCat()
        }

        //add a function when there is a change of value in the category checkboxes
        checksCategories.forEach(element => {
            element.addEventListener('change', handleAddArrayCat)

        })

        //Function that creates an element for each selected category
        const ArrayCat = () => {
            document.querySelector('#categories-check').innerHTML = '';
            checksCategories.map(element =>{

                //Checks if the category is selected, then create an element
                if(element.checked){
                    let name = element.getAttribute('data-handle-name')
                    let id = element.getAttribute('data-handle-id')
                    let divCategory = document.createElement('div')
                    divCategory.classList.add('col-lg-3')
                    divCategory.setAttribute('data-ref-id', id)
                    divCategory.innerHTML = `
                    <div class="box-show-cat-select">
                        <p>${name}</p>
                        <i class="material-icons" data-handle-rm-check="${id}">delete</i>
                    </div>
                    `
                    document.querySelector('#categories-check').appendChild(divCategory)
                    return element;
                }

                //If not, it returns empty.
                return '';
            })

            //Adds the function to remove a category when clicking on the button with the selected attribute
            document.querySelectorAll('[data-handle-rm-check]').forEach( element => {
                element.addEventListener('click', handleRmCatList)
            })
        }

        //Starts the function to generate the elements of the selected categories
        ArrayCat()
    }

    //Add plugins to filepond plugin
    FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

    //Function to start assembling input file elements
    const mountFilesPlugin = () => {

        let inputsFilesImg = document.querySelectorAll('input[type="file"]');

        inputsFilesImg.forEach(element => {
            let haveImage = element.getAttribute('data-value-image');
            let isMultiple = element.getAttribute('multiple');
            labelIdle = `
            <svg width="20" height="20" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.9165 17.3334C11.9165 17.6403 12.0205 17.8974 12.2285 18.1047C12.4358 18.3127 12.6929 18.4167 12.9998 18.4167C13.3068 18.4167 13.5643 18.3174 13.7723 18.1188C13.9795 17.9202 14.0832 17.6674 14.0832 17.3605V14.0834H16.0332C16.2859 14.0834 16.4528 13.9707 16.5337 13.7454C16.6153 13.5193 16.5748 13.325 16.4123 13.1625L13.379 10.1292C13.2707 10.0209 13.1443 9.96671 12.9998 9.96671C12.8554 9.96671 12.729 10.0209 12.6207 10.1292L9.58734 13.1625C9.42484 13.325 9.38439 13.5193 9.466 13.7454C9.54689 13.9707 9.71373 14.0834 9.9665 14.0834H11.9165V17.3334ZM4.33317 21.6667C3.73734 21.6667 3.22745 21.4547 2.8035 21.0308C2.37884 20.6061 2.1665 20.0959 2.1665 19.5V6.50004C2.1665 5.90421 2.37884 5.39432 2.8035 4.97037C3.22745 4.54571 3.73734 4.33337 4.33317 4.33337H9.93942C10.2283 4.33337 10.5038 4.38754 10.766 4.49587C11.0274 4.60421 11.2575 4.75768 11.4561 4.95629L12.9998 6.50004H21.6665C22.2623 6.50004 22.7726 6.71237 23.1973 7.13704C23.6212 7.56099 23.8332 8.07087 23.8332 8.66671V19.5C23.8332 20.0959 23.6212 20.6061 23.1973 21.0308C22.7726 21.4547 22.2623 21.6667 21.6665 21.6667H4.33317Z" />
            </svg>
            Click or Drag
            `

            //All these properties and attributes you can learn more directly in the plugin documentation to better understand: Filepond
            if ( isMultiple == '' ) {

                FilePond.create(element, {
                    labelIdle,
                    storeAsFile: true,
                    maxFiles: 15,
                    itemInsertLocation: 'after',
                    allowImagePreview: true,
                    allowFileSizeValidation: true,
                    imagePreviewHeight: 130,
                    maxFileSize: "3MB",
                    fileValidateTypeDetectType: (source, type) =>
                        new Promise((resolve, reject) => {
                            resolve(type);
                        }),
                    imagePreviewTransparencyIndicator: "grid",
                });
            } else {
                FilePond.create(element, {
                    labelIdle,
                    storeAsFile: true,
                    files: haveImage ? [{source: element.getAttribute('data-value-image')}] : '',
                    allowImagePreview: true,
                    allowFileSizeValidation: true,
                    maxFileSize: "3MB",
                    fileValidateTypeDetectType: (source, type) =>
                        new Promise((resolve, reject) => {
                            resolve(type);
                        }),
                    imagePreviewTransparencyIndicator: "grid",
                });
            }

        });
    }

    mountFilesPlugin();

    //Functions to generate dynamic inputs
    let listToggleNewInput = document.querySelectorAll('[data-handler=newinput]')
    let listToggleNewInputLessons = document.querySelectorAll('[data-handler=newinputlessons]')
    let listToggleNewInputFormPractitioner = document.querySelectorAll('[data-handler=newinputformpractitioner]')
    let listToggleDeleteInput = document.querySelectorAll('.icon-delete')

    listToggleNewInput.forEach( (element) => element.addEventListener('click', handlerNewInputs))
    listToggleNewInputLessons.forEach( (element) => element.addEventListener('click', handlerNewInputsLessons))
    listToggleNewInputFormPractitioner.forEach( (element) => element.addEventListener('click', handlerNewInputsFormPractitioner))
    listToggleDeleteInput.forEach( element => element.addEventListener('click', PackageDeleteInputs))
    listToggleDeleteInput.forEach( element => element.addEventListener('click', RecurrenceDeleteInputs))
    let btnDel = document.querySelectorAll('.delete-package')
    let btnDelRecurrence = document.querySelectorAll('.delete-recurring')
    let inputsDinamicsInBox = document.querySelectorAll(`.packages .box-inputs-dinamic`).length;
    let inputsDinamicsInBoxRecurrence = document.querySelectorAll(`.recurrence .recurrenceDiv`).length;

    if(inputsDinamicsInBox == 1) {
        btnDel.forEach(btn => {
            btn.classList.add('d-none')
        })
    }

    if(inputsDinamicsInBoxRecurrence == 1){
        btnDelRecurrence.forEach(btn => {
            btn.classList.add('d-none')
        })
    }

    let deleteRecurrence = [];
    function RecurrenceDeleteInputs(event, recurrenceId) {

    let allRecurrences = document.querySelectorAll('.recurrences .recurrenceDiv');
    let recurrencesId = [];

    if (recurrenceId != null) {
        deleteRecurrence.push(recurrenceId);
        document.getElementById('recurrencesId').value = deleteRecurrence.join(',');
        let element = document.getElementById('recurrence_' + recurrenceId);
        element.parentNode.removeChild(element);
    }

    if (allRecurrences.length >= 1) {
        var targetElement = event.target || event.srcElement;

        if (targetElement === allRecurrences[0].querySelector('.icon-delete')) {
            return;
        }
        var parentElement = targetElement.parentElement;

        parentElement.remove();

        allRecurrences = document.querySelectorAll('.recurrences .recurrenceDiv');
    }
}

function updateDeleteButtons() {
    let btnDelRecurrence = document.querySelectorAll('.delete-recurring');
    let inputsDinamicsInBoxRecurrence = document.querySelectorAll(`.recurrence .recurrenceDiv`).length;

    if(inputsDinamicsInBoxRecurrence <= 1){
        btnDelRecurrence.forEach(btn => {
            btn.classList.add('d-none');
        });
    } else {
        btnDelRecurrence.forEach(btn => {
            btn.classList.remove('d-none');
        });
    }
}

    function PackageDeleteInputs(event) {
        let inputsDinamicsInBox = document.querySelectorAll(`.packages .box-inputs-dinamic`).length;
        let inputsDinamicsInBoxValues = event.target.parentNode.querySelectorAll(`.packages .box-inputs-dinamic input`)
        let values = []
        inputsDinamicsInBoxValues.forEach((input) => {values.push(input.value)});
        let haveValue = values.some((valor) => { return valor !== '';});

        if(haveValue) {
            if(inputsDinamicsInBox > 1) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "If you delete it, you will lose the data entered in it when saving!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            event.target.parentNode.parentNode.remove()
                            if(inputsDinamicsInBox == 2) {
                                btnDel.forEach(btn => {
                                btn.classList.add('d-none')
                                })
                            }
                        }
                })
                return
            }
        }

        if(inputsDinamicsInBox > 1) {
            event.target.parentNode.parentNode.remove()
            if(inputsDinamicsInBox == 2) {
                btnDel.forEach(btn => {
                btn.classList.add('d-none')
                })
            }
            return
        }
    }

    function alertDeleteHaveOrder() {
        Swal.fire({
            title: 'You cannot delete this package!',
            text: "This package is linked to an order.",
            icon: 'warning',
            showCancelButton: true,
        });
    }

    function alertDeleteServiceOrder() {
        Swal.fire({
            title: 'You cannot delete this service!',
            text: "This service is linked to an order.",
            icon: 'warning',
            showCancelButton: true,
        });
    }

    function alertDeleteContentPurchase() {
        Swal.fire({
            title: 'You cannot delete this content!',
            text: "This service is linked to an purchase.",
            icon: 'warning',
            showCancelButton: true,
        });
    }

    function enableGoogleAnalyticsCookies() {
        window['ga-disable-G-XFH5YHST2Q'] = false;
        var script = document.createElement('script');
        script.src = 'https://www.googletagmanager.com/gtag/js?id=G-XFH5YHST2Q';
        script.async = true;
        document.head.appendChild(script);
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XFH5YHST2Q');
    }

    //Function that adds new entries
    function handlerNewInputs() {

        let idName = this.getAttribute("data-ratio")
        let name = this.getAttribute("data-name")
        let limit = this.getAttribute("data-limit-char")
        let placeholder = this.getAttribute("data-placeholder")
        let arrayBox = document.querySelectorAll(`.${idName} .box-inputs-dinamic`).length
        let divContent = document.createElement("div")

        divContent.classList.add("d-flex", "align-item-center", "remove-extras", "box-inputs-dinamic")
        divContent.innerHTML = `
        <input id="${idName}_${arrayBox}" name="${idName}[${arrayBox}][link]" type="text" required ${limit? 'maxlength=' + limit : ''}
            class="form-control form-control-prepended" placeholder="${placeholder}"/>
        <div class="p-1">
            <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="videos">delete</i>
        </div>
        `

        this.parentNode.insertBefore(divContent, null)

    }

    //Function that adds new entries
    function handlerNewInputsFormPractitioner() {

        let idName = this.getAttribute("data-ratio")
        let name = this.getAttribute("data-name")
        let limit = this.getAttribute("data-limit-char")
        let placeholder = this.getAttribute("data-placeholder")
        let arrayBox = document.querySelectorAll(`.${idName} .box-inputs-dinamic`).length
        let divContent = document.createElement("div")

        divContent.classList.add("d-flex", "align-item-center", "remove-extras", "box-inputs-dinamic")
        divContent.innerHTML = `
        <input id="${idName}_${arrayBox}" name="${idName}[${arrayBox}][name]" type="text" required ${limit? 'maxlength=' + limit : ''}
            class="form-control form-control-prepended" placeholder="${placeholder}"/>
        <div class="p-1">
            <i onclick="removeExtras()" class="bi bi-trash3-fill btn-extras"></i>
        </div>
        `

        this.parentNode.insertBefore(divContent, null)
    }

    function renderizeSelect() {
        'use strict';

        $.fn.select2.defaults.set('theme', 'bootstrap4');

        function templateResult(a) {
            if (!a.id) return a.text;
            var e = $(a.element).data("avatar-src");
            return e
                ? $('<span class="avatar avatar-xs mr-2"><img class="avatar-img rounded-circle" src="' + e + '" alt="' + a.text + '"></span><span>' + a.text + '</span>')
                : a.text;
        }

        $('[data-toggle="select"]').each(function () {
            var element = $(this);
            var options = {
                dropdownParent: element.closest(".modal").length ? element.closest(".modal") : $(document.body),
                minimumResultsForSearch: element.data("minimum-results-for-search"),
                templateResult: templateResult
            };
            element.select2(options);
        });
    }

    // Remove Extras Function
    let listDeletExtras = document.querySelectorAll('.btn-extras')
    listDeletExtras.forEach( element => element.addEventListener('click', removeExtras))

    function removeExtras() {
        let btnDel = document.querySelectorAll('.btn-extras');
        event.target.parentNode.parentNode.remove()
    }

    function removeLessons() {
        let qntBoxLesson = document.querySelectorAll(`.lessons .box-inputs-dinamic`).length
        let allButtonsDelete = document.querySelectorAll(`.lessons .box-inputs-dinamic .icon-delete`)
        if (qntBoxLesson == 2) {
            allButtonsDelete.forEach( e => {
                e.classList.add('d-none')
            })
            event.target.parentNode.parentNode.parentNode.remove()
        } else if (qntBoxLesson > 1) {
            event.target.parentNode.parentNode.parentNode.remove()
        } else {
            Swal.fire({
                title: 'You need this field',
                text: "You selected the 'course' option so you need at least 1 lesson",
                icon: 'error'
            })
        }

    }

    if (document.querySelector('[data-handler=newinputExtras]')) {
        let NewInputExtras = document.querySelector('[data-handler=newinputExtras]')
        NewInputExtras.addEventListener('click', handlerNewInputsExtras)
        function handlerNewInputsExtras() {

            let idName = this.getAttribute("data-ratio")
            let name = this.getAttribute("data-name")

            let arrayBox = document.querySelectorAll(`.${idName} .box-inputs-dinamic`).length
            let divContent = document.createElement("div")

            divContent.classList.add("box-inputs-dinamic","container-fluid")
            divContent.innerHTML = `
                <div class="row">
                <div class="col-8 col-lg-8 pl-0">
                    <label class="text-label">Name</label>
                    <input id="extra_name${arrayBox}" name="${idName}[${arrayBox}][${name}]" type="text" min="0" required
                    class="form-control form-control-prepended"/>
                </div>

                <div class="col-4 col-lg-4 pl-0">
                    <label class="text-label">price</label>
                    <input id="extra_price${arrayBox}" name="${idName}[${arrayBox}][price]" type="number" required
                    class="form-control form-control-prepended"/>
                </div>
                </div>
            `

            this.parentNode.insertBefore(divContent, null)

        }
    }

    let isIndividual = document.querySelector('.type-service')

    if (document.querySelector('[data-handler=newinputPackages]')) {

        let NewInputPackages = document.querySelector('[data-handler=newinputPackages]')
        NewInputPackages.addEventListener('click', handlerNewInputsPackages)
        function handlerNewInputsPackages() {

            let valueIsOne = ''
            let colorOff = ''
            if(isIndividual.value == 2) {
                valueIsOne = 'value="1"'
                colorOff = 'color:#0000;pointer-events:none;background-color:#e9ecef;'
            }

            let idName = this.getAttribute("data-ratio")
            let name = this.getAttribute("data-name")
            let arrayBox = document.querySelectorAll(`.${idName} .box-inputs-dinamic`).length
            let divContent = document.createElement("div")
            let btnDel = document.querySelectorAll('.delete-package');
            btnDel.forEach(btn => {
                btn.classList.remove('d-none')
            })

            divContent.classList.add("box-inputs-dinamic","container-fluid")
            divContent.innerHTML = `
                <div id="packages_${arrayBox}" class="row align-items-end">

                    <div class="col-lg-5 pl-0">
                        <label class="text-label">Options *</label>
                        <input id="package_name${arrayBox}" name="${idName}[${arrayBox}][${name}]" type="text" required placeholder="[Type of Service OR ticket OR accomodation]"
                        class="form-control form-control-prepended"/>
                    </div>

                    <div class="col-5 col-lg-2 pl-0">
                        <label class="text-label">price *</label>
                        <input id="package_price${arrayBox}" name="${idName}[${arrayBox}][price]" type="number" required min="0" placeholder="&#163"
                        class="form-control form-control-prepended"/>
                    </div>

                    <div class="col-5 col-lg-2 pl-0">
                        <label class="text-label">Quantity *</label>
                        <input style="${colorOff}" id="package_quantity${arrayBox}" name="${idName}[${arrayBox}][quantity]" type="number" required min="1"
                        ${valueIsOne} class="qty form-control form-control-prepended"/>
                    </div>
                    <div class="col-5 col-lg-1 pl-0">
                        <x-input-label for="duration" :value="__('Duration*')" />
                        <x-text-input id="duration" name="packages[${arrayBox}][duration]" type="number"
                        class="form-control" min="0" required value="{{old('0', isset($service) ? $service->duration : '')}}"/>
                    </div>
                    <div class="col-5 col-lg-1 pl-0">
                        <div class="input-group-append">
                            <select name="packages[${arrayBox}][duration_type]" class="form-control" data-toggle="select">
                                <option value="1" {{ (old('duration_type', isset($service) ? $package->duration_type : '') == 1) ? 'selected' : '' }}>{{ __('Days') }}</option>
                                <option value="2" {{ (old('duration_type', isset($service) ? $package->duration_type : '') == 2) ? 'selected' : '' }}>{{ __('Hours') }}</option>
                                <option value="3" {{ (old('duration_type', isset($service) ? $package->duration_type : '') == 3) ? 'selected' : '' }}>{{ __('Minutes') }}</option>
                            </select>
                        </div>
                    </div>
                    <i class="material-icons icon-delete delete-package" onclick="PackageDeleteInputs(event)" data-ratio="packages">delete</i>

                    <div class="col-12 p-0">
                        <label class="text-label">Description *</label>
                        <textarea id="package_description${arrayBox}" name="${idName}[${arrayBox}][description]" placeholder="Brief Description"
                        class="form-control form-control-prepended"></textarea>
                    </div>

                    <div class="col-5 col-lg-3 pl-0 pt-2">
                        <input  type="file" accept="image/png, image/jpeg, image/jpg" name="packages_galleries[${arrayBox}][]" multiple />
                        <x-input-error class="mt-2" :messages="$errors->get('packages_galleries')" />
                    </div>

                </div>
            `

            this.parentNode.insertBefore(divContent, null)
            renderizeSelect();
            mountFilesPlugin();
        }
    }

    //Start of functions that add new subcategory field
    function removeSubCat(event) {
        let idElementToBeRemoved = event.target.getAttribute('data-ref-boxsubcat')
        document.querySelector(`#${idElementToBeRemoved}`).remove()
    }

    //Picking up all subcategories already created, if any
    let arrayBoxSubCat = document.querySelectorAll(`.box-inputs-dinamic`).length;

    if (document.querySelector('[data-handler=newinputSubcat]')) {
        let NewInputSubCat = document.querySelector('[data-handler=newinputSubcat]')
        NewInputSubCat.addEventListener('click', handlerNewInputsSubCat)

        //Função que cria um novo campo de subcategoria
        function handlerNewInputsSubCat() {

            let divContent = document.createElement("div")
            let conteudo = `
            <div class="row">

                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons icon-delete-subcat"
                onclick="removeSubCat(event)" data-ref-boxsubcat="subcategory_${arrayBoxSubCat}" >delete</i>

                <div class="col-lg-7">
                    <div>
                        <x-input-label for="subcategories_name${arrayBoxSubCat}" value="${arrayBoxSubCat + 1}. Subcategory Name" />
                        <x-text-input id="subcategories_name${arrayBoxSubCat}" required
                            name="subcategories[${arrayBoxSubCat}][name]" type="text" />
                        <x-input-error class="mt-2" :messages="$errors->get('subcategories.${arrayBoxSubCat}.name')" />
                    </div>
                    <div>
                        <x-input-label for="subcategories_description${arrayBoxSubCat}" :value="__('Description')" />
                        <textarea name="subcategories[${arrayBoxSubCat}][description]" id="subcategories_description${arrayBoxSubCat}" rows="4"
                            class="form-control"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('subcategories.${arrayBoxSubCat}.description')" />
                    </div>
                </div>
                <div class="col-lg-5">
                    <x-input-label for="subcategories_icon${arrayBoxSubCat}" :value="__('Icon')" />
                    <input type="file" required name="subcategories[${arrayBoxSubCat}][icon]" accept="image/png, image/jpeg, image/jpg"/>
                    <x-input-error class="mt-2" :messages="$errors->get('subcategories.${arrayBoxSubCat}.icon')" />
                </div>

            </div>
            `

            divContent.setAttribute('id',`subcategory_${arrayBoxSubCat}`)
            divContent.classList.add("box-inputs-dinamic", "col-md-6")
            divContent.innerHTML = conteudo;

            document.querySelector("#inputsSubCat").insertBefore(divContent, null)

            //Reassembling the images plugin to add the newly created inputs
            mountFilesPlugin()

            //Incrementing the array of subcategories to avoid creating a new element with the same id
            arrayBoxSubCat++
        }
    }

    // Add validation for checks inputs goals
    let checkedsGoals = Array.from(document.querySelectorAll('.check-goals'));

    checkedsGoals.forEach( element =>{
        element.addEventListener('change', event => {
            let checkedsGoalsMark = checkedsGoals.filter( element => element.checked == true)

            if (checkedsGoalsMark.length > 5) {
                Swal.fire({
                    title: 'Select only 5',
                    text: "You have already chosen 5 of the options, if you want to change, remove any of the selected options",
                    icon: 'error'
                })
                event.target.checked = false
            }
        })
    })

if (document.querySelector('[data-handler=newinputRecurrence]')) {

    let NewInputRecurrence = document.querySelector('[data-handler=newinputRecurrence]')
    NewInputRecurrence.addEventListener('click', handlerNewInputsRecurrence)
    function handlerNewInputsRecurrence() {

        let idName = this.getAttribute("data-ratio")
        let arrayBox = document.querySelectorAll('.recurrenceDiv').length
        let divContent = document.createElement("div")
        let btnDel = document.querySelectorAll('.delete-recurrence');
        btnDel.forEach(btn => {
            btn.classList.remove('d-none')
        })

        divContent.classList.add("recurrenceDiv","container-fluid")
        divContent.innerHTML = `
            <div id="recurrence_${arrayBox}" class="row align-items-end mb-3">

                <div class="col-lg-5 pl-0">
                    <x-input-label for="start" :value="__('Start *')" />
                    <div class="flatpickr">
                        <input  type="datetime-local" name="start_date[${arrayBox}]" required id="start_date[${arrayBox}]"
                            class="form-control" placeholder="Choose start date"
                            data-toggle="flatpickr" data-flatpickr-enable-time="true"
                            data-flatpickr-alt-format="F j, Y at H:i"
                            data-flatpickr-date-format="Y-m-d H:i"
                            value="{{ old('start_date[${arrayBox}]') }}">
                        <i class="fa fa-calendar-alt p-0"></i>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('${idName}.${arrayBox}.start_date')" />
                </div>

                <div class="col-5 col-lg-5 pl-0 ">
                    <x-input-label for="end" :value="__('End *')" />
                    <div class="flatpickr">
                        <input type="datetime-local" name="end_date[${arrayBox}]" required id="end_date[${arrayBox}]"
                            class="form-control" placeholder="Choose end date"
                            data-toggle="flatpickr" data-flatpickr-enable-time="true"
                            data-flatpickr-alt-format="F j, Y at H:i"
                            data-flatpickr-date-format="Y-m-d H:i"
                            value="{{ old('${idName}.${arrayBox}.end_date') }}">
                        <i class="fa fa-calendar-alt p-0"></i>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('${idName}.${arrayBox}.end_date')" />
                </div>

                <i class="material-icons icon-delete delete-recurrence" onclick="RecurrenceDeleteInputs(event)" data-ratio="${idName}">delete</i>

            </div>
        `
        this.parentNode.insertBefore(divContent, null)
        renderInputDate()
    }
}

if (document.querySelector('#cost')) {

    const inputCost = document.querySelector('#cost')

    const verifyCost = () => {
        const packages = document.querySelector('#box-packages')
        if (inputCost.value == 2) {
            packages.classList.remove('d-none')
        } else {
            packages.classList.add('d-none')
        }
    }

    $(inputCost).on('change', function (e) {
        verifyCost()
    });

    verifyCost()
}

//Function that adds new entries
function handlerNewInputsLessons() {

    let arrayBox = document.querySelectorAll(`.lessons .box-inputs-dinamic`).length
    let divContent = document.createElement("div")

    divContent.classList.add("d-flex", "remove-extras", "box-inputs-dinamic")
    divContent.innerHTML = `
    <div class="w-100" style="padding:10px;border:1px solid #7f9c713d;border-radius:10px;margin:10px 0;position:relative;">
        <label class="text-label pt-2">Title *</label>
        <input id="lessons_title_${arrayBox}" name="lessons[${arrayBox}][title]" type="text" required
            class="form-control form-control-prepended"/>

        <label class="text-label pt-2">Subtitle *</label>
        <input id="lessons_subtitle_${arrayBox}" name="lessons[${arrayBox}][subtitle]" type="text" required
        class="form-control form-control-prepended"/>

        <label class="text-label pt-2">Video URL *</label>
        <x-tooltip-info id='infogroup_size' :info="__('Use https:// before the www. link. Example: https://www.youtube.com/yourvideo. Add Vimeo or Youtube link.')" />
        <input id="lessons_url_${arrayBox}" name="lessons[${arrayBox}][url]" type="text" required
        class="form-control form-control-prepended"/>
        <div style="position:absolute;right:0;top:5px;z-index:2;">
            <i onclick="removeLessons()" style="font-size:18px;" class="material-icons icon-delete" data-ratio="lessons">delete</i>
        </div>
    </div>
    `
    let allButtonsDelete = document.querySelector(`.lessons .box-inputs-dinamic .icon-delete`)
    if (allButtonsDelete) {
        allButtonsDelete.classList.remove('d-none')
    }

    document.querySelector("[data-handler=newinputlessons]").parentNode.insertBefore(divContent, null)

}

if (document.querySelector('.type-content-options')) {

    const inputTypeContent = document.querySelector('.type-content-options')

    const verifyTypeContent = () => {
        const lessons = document.querySelector('#box-lessons')
        const boxUrlVideo = document.querySelector('#box-url')
        const inputUrlVideo = document.querySelector('#url')
        let allInputsInLessons = document.querySelectorAll(`.lessons .box-inputs-dinamic input`)
        if (inputTypeContent.value == 2) {
            lessons.classList.remove('d-none')
            inputUrlVideo.removeAttribute('required')
            boxUrlVideo.classList.add('d-none')
            if (allInputsInLessons.length == 0 ) {
                handlerNewInputsLessons()
            }
            if (allInputsInLessons) {
                allInputsInLessons.forEach( e => {
                    e.setAttribute('required','true')
                })
            }
        } else {
            lessons.classList.add('d-none')
            inputUrlVideo.setAttribute('required','true')
            boxUrlVideo.classList.remove('d-none')
            if (allInputsInLessons) {
                allInputsInLessons.forEach( e => {
                    e.removeAttribute('required')
                })
            }
        }
    }

    $(inputTypeContent).on('change', function (e) {
        verifyTypeContent()
    });

    verifyTypeContent()
}
</script>
