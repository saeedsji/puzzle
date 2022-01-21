@extends('layouts.panel')
@section('title', 'تنظیمات عمومی')

@section('style')
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">تنظیمات عمومی</h4>
            </div>
        </div>
    </div>
    <form action="{{ route('setting.generalStore') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">شماره تماس 1</label>
                                    <input type="text" name="phone1" class="form-control englishText"
                                           value="{{!empty(option('phone1')) ? option('phone1') : old('phone1')}}"
                                           id="phone1">
                                    @error('phone1')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">شماره تماس 2</label>
                                    <input type="text" name="phone2" class="form-control englishText"
                                           value="{{!empty(option('phone2')) ? option('phone2') : old('phone2')}}"
                                           id="phone2">
                                    @error('phone2')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">ایمیل</label>
                                    <input type="text" name="email" class="form-control englishText"
                                           value="{{!empty(option('email')) ? option('email') : old('email')}}"
                                           id="email">
                                    @error('email')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">لینک واتس اپ</label>
                                    <input type="text" name="whatsapp" class="form-control englishText"
                                           value="{{!empty(option('whatsapp')) ? option('whatsapp') : old('whatsapp')}}"
                                           id="whatsapp">
                                    @error('whatsapp')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telegram">لینک تلگرام</label>
                                    <input type="text" name="telegram" class="form-control englishText"
                                           value="{{!empty(option('telegram')) ? option('telegram') : old('telegram')}}"
                                           id="telegram">
                                    @error('telegram')
                                    @include('admin.components.validation')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="aboutus">درباره ما</label>
                                <textarea id="aboutus" name="aboutus">{!! option('aboutus') !!}</textarea>
                            </div>

                            <div class="col-12 mt-5">
                                <label for="rules">قوانین و مقررات</label>
                                <textarea id="rules" name="rules">{!! option('rules') !!}</textarea>
                            </div>
                            <div class="col-12 mt-5">
                                <label for="privacy">حریم خصوصی</label>
                                <textarea id="privacy" name="privacy">{!! option('privacy') !!}</textarea>
                            </div>
                            <div class="col-12 mt-5">
                                <label for="warning">هشدار پلیس</label>
                                <textarea id="warning" name="warning">{!! option('warning') !!}</textarea>
                            </div>
                            <div class="col-12 mt-5">
                                <label for="patchNote">تغییرات ورژن</label>
                                <textarea id="patchNote" name="patchNote">{!! option('patchNote') !!}</textarea>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-100">
                                    <i class="bx bx-check font-size-18 align-middle mr-2"></i>بروزرسانی اطلاعات
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">عملیات</h4>
                        <hr/>
                        <button type="submit" class="btn btn-success waves-effect waves-light w-100">
                            <i class="bx bx-check font-size-18 align-middle mr-2"></i>بروزرسانی اطلاعات
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')

    <script src="/assets/panel/libs/tinymce/tinymce.min.js"></script>
    <script src="/assets/panel/libs/tinymce/langs/fa_IR.js"></script>

    <script>
        $(document).ready(function () {
            if ($("#aboutus").length > 0) {
                tinymce.init({
                    language: "fa_IR",
                    selector: "textarea#aboutus",
                    height: 500,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table directionality emoticons template paste"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
            if ($("#rules").length > 0) {
                tinymce.init({
                    language: "fa_IR",
                    selector: "textarea#rules",
                    height: 500,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table directionality emoticons template paste"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
            if ($("#privacy").length > 0) {
                tinymce.init({
                    language: "fa_IR",
                    selector: "textarea#privacy",
                    height: 500,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table directionality emoticons template paste"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
            if ($("#warning").length > 0) {
                tinymce.init({
                    language: "fa_IR",
                    selector: "textarea#warning",
                    height: 500,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table directionality emoticons template paste"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
            if ($("#patchNote").length > 0) {
                tinymce.init({
                    language: "fa_IR",
                    selector: "textarea#patchNote",
                    height: 500,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table directionality emoticons template paste"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });
    </script>
@endsection
