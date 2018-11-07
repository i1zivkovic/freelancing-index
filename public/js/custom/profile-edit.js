$('#skill_list').select2({

    width: '100%',
    placeholder: "Choose skills...",
    minimumInputLength: 2,
    ajax: {
        delay: 300,
        url: 'skills/find',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});







/* .---------------------------------------------------------------------------------------------------------------------------------- */

var max_experiences = 10; // maximum experiences
var experience_wrapper = $(".experience-entry"); //  experience wrapper
var experience_add_button = $("#add-experience"); // add button
var educations = $(".experience-entry .row").length; // length of experience entries


var x = educations; // initial experience count
$(experience_add_button).click(function (e) { //on add input button click

    e.preventDefault();
    if (x < max_experiences) { //max experiences allowed
        x++;
        if (x > 0) {
            $('#submit-experience').removeAttr('disabled'); // if there are experiences
        }
        $(experience_wrapper).append( //append another form
            `   <div class="row mb-3">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Company Name</label>
                                    <input type="text" class="form-control" placeholder="" name="company_name[]"
                                        required value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Job Title</label>
                                    <input type="text" class="form-control" placeholder="" name="job_title[]"
                                        required value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="control-label">Job Description</label>
                                    <textarea name="job_description[]" id="" cols="30" rows="7" class="form-control"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <input type="text" class="form-control" placeholder="" name="job_location_country[]"
                                        value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control" placeholder="" name="job_location_city[]"
                                        value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="date" class="form-control" placeholder="" name="start_date[]"
                                        value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="date" class="form-control" placeholder="" name="end_date[]" value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 ">
                                <div class="add-post-btn">
                                  <a href="#!" class="btn-delete remove-experience">Remove</a>
                                </div>
                                <hr>
                            </div>
                        </div>
                       `
        ); //add input box
    } else {
        $('#submit-experience').attr('disabled', true); // if there are no forms
    }
});

$(experience_wrapper).on("click", ".remove-experience", function (e) { //user click on remove
    e.preventDefault();
    $(this).parent().parent().parent('div').remove(); // find the parent div and remove whole form
    x--;

    if (x == 0) {
        $('#submit-experience').attr('disabled', true); // toggle disabled attribute
    } else {
        $('#submit-experience').removeAttr('disabled');
    }
})

/*  --- --------------------------------------------------------------------------------------------------------------------------------------------- */


var max_educations = 10;
var education_wrapper = $(".education-entry");
var education_add_button = $("#add-education");
var educations = $(".education-entry .row").length;


var x = educations;
$(education_add_button).click(function (e) {

    e.preventDefault();
    if (x < max_educations) {
        x++;
        if (x > 0) {
            $('#submit-education').removeAttr('disabled');
        }
        $(education_wrapper).append(
            `        <div class="row mb-3">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Institution Name</label>
                                    <input type="text" class="form-control "
                                        placeholder="" name="institution_name[]" required value="">

                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Major</label>
                                    <input type="text" class="form-control "
                                        placeholder="" name="major[]" required value="">

                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="control-label">Degree</label>
                                    <input type="text" class="form-control"
                                        placeholder="" name="degree[]" required value="">

                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description[]" id="" cols="30" rows="7" class="form-control"
                                        ></textarea>

                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="date" class="form-control "
                                        placeholder="" name="start_date[]" value="">

                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="date" class="form-control"
                                        placeholder="" name="end_date[]" value="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="add-post-btn">
                                    <a href="#!" class="btn-delete remove-education">Remove</a>
                                </div>
                                <hr>
                            </div>
                        </div>
                       `
        );
    } else {
        $('#submit-education').attr('disabled', true);
    }
});

$(education_wrapper).on("click", ".remove-education", function (e) {
    e.preventDefault();
    $(this).parent().parent().parent('div').remove();
    x--;

    if (x == 0) {
        $('#submit-education').attr('disabled', true);
    } else {
        $('#submit-education').removeAttr('disabled');
    }
})
