<div data-repeater-item="" class="row repeater-item" style="margin-top:5%; border-bottom:dashed 1px rgb(138, 132, 132); display:none">
    <div class="col-md-10">
        {{-- <div class="form-group row">
            <div class="col-md-3">
                <label for="" class="col-form-label pull-right">
                    Subject <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                </label>
            </div>
            <div class="col-md-9">
                <div id="bloodhound">
                    <input name="question_subjects" class="typeahead tags" type="text" class="form-control" autocomplete="off">
                </div>
            </div>
        </div> --}}
        <div class="form-group row">
            <div class="col-md-3">
                <label for="" class="col-form-label pull-right">
                    Question Type <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                </label>
            </div>
            <div class="col-md-9">
                <select name="type" class="form-control question_type" onchange="setOptionGroup(this)" required disabled>
                    <option value="">Pilih Question Type</option>
                    <option value="essay">Essay</option>
                    <option value="multiple_choice">Multiple Choice</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="" class="col-form-label pull-right">
                    Question Description <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                </label>
            </div>
            <div class="col-md-9">
                <textarea class="summernote question_description" name="question_description" required disabled></textarea>
            </div>
        </div>
        <div class="form-group row options" style="display: none">
            <div class="col-md-3">
                <label for="" class="col-form-label pull-right">
                    Options <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Subjects"></i>
                </label>
            </div>
            <div class="col-md-9">
                <!-- innner repeater -->
                <div class="inner-repeater">
                    <div data-repeater-list="group-options">
                        <div data-repeater-item style="margin-bottom:1%" class="inner-repeater-item">
                            <div class="input-group row">
                                <div class="input-group-prepend col-md-2" style="padding-right:0 !important">
                                    <a type="button" class="btn btn-light" style="width: 100%; border:solid 1px rgb(197, 194, 194)">Label</a>
                                </div>
                                <input type="text" name="option_label" class="form-control-sm col-md-2 option_label" value="A" style="border:solid 1px rgb(197, 194, 194); max-width:12% !important; text-align:center" readonly/>
                                <div class="input-group-prepend col-md-2" style="padding-right:0 !important;padding-left:0 !important">
                                    <a type="button" class="btn btn-light" style="width: 100%; border:solid 1px rgb(197, 194, 194)">Value</a>
                                </div>
                                <input type="text" name="option_description" class="form-control-sm col-md-4 input-sm option_description" value="Jawaban Option" style="border:solid 1px rgb(197, 194, 194)" required disabled/>
                                <input type="checkbox" name="answer_status" class="form-control-sm col-md-1 answer_status" onclick="reinitAnswerStatus(this)" checked/>
                                <input data-repeater-delete type="button" class="btn btn-danger col-md-1 btn-delete-inner-repeater-item" value="X" onclick="reArrangeOptionLabel(this)"/>
                            </div>
                        </div>
                    </div>
                    <input data-repeater-create type="button" value="+ Add Option" class="btn btn-light btn-add-inner-repeater-item" style="border:solid 1px rgb(197, 194, 194)" onclick="setNextLabel(this)"/>
                </div>
            </div>
        </div>
        <div class="form-group row points" style="display: none">
            <label class="col-md-3">
                <div class="col-form-label pull-right">
                    Point <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Exam Status"></i>
                </div>
            </label>
            <div class="col-md-9">
                <div class="input-grup row" style="margin-left: 1px">
                    <div class="input-group-prepend wrong-point" style="padding-right: 0; display:none">
                        <span class="input-group-text btn btn-danger"><i class="la la-times"></i></span>
                    </div>
                    <input type="number" max="0" class="form-control col-md-2 input-sm wrong-point" name="wrong_point" style="display:none" disabled required>

                    <div class="input-group-prepend correct-point" style="padding-right: 0; margin-left:15px; display:none">
                        <span class="input-group-text btn btn-success"><i class="la la-check"></i></span>
                    </div>
                    <input type="number" min="0" class="form-control col-md-2 input-sm correct-point" name="correct_point" style="display:none" disabled required>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="form-check">
                    <input type="checkbox" name="use_default_correct_point" class="form-check-input default-correct-checkbox" onchange="handleDefaultCorrectPoint(this)" checked>
                    <label class="form-check-label default-correct-label" for="exampleCheck1">Use Default Correct Point</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="form-check">
                    <input type="checkbox" name="use_default_wrong_point" class="form-check-input default-wrong-checkbox" onchange="handleDefaultWrongPoint(this)" checked>
                    <label class="form-check-label default-wrong-label" for="exampleCheck1">Use Default Wrong Point</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <input data-repeater-delete="" type="button" value="X Delete Question" class="btn btn-danger"/>
    </div>
</div>
