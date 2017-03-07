function initFieldTypeSettingDescribe(fieldType, fieldValue, describeField, otherField) {
    this.fieldType = fieldType;
    this.fieldValue = fieldValue;
    this.describeField = describeField;
    this.otherField = otherField;

    this.declarePattern = function (type) {
        switch (type) {
            case 'CHECKBOX':
            case 'RADIO':
            case 'SELECT':
            case 'SELECT_MULTIPLE': return "{\n  \"lists\": [\n    {\"key\": \"1\", \"text\": \"first\"},\n    {\"key\": \"2\", \"text\": \"second\"},\n    {\"key\": \"3\", \"text\": \"third\"}\n  ]\n}";
            case 'FILE': return "{\n  \"directory\": \"path/to/folder/to/keep/files\",\n  \"acceptTypes\": \"File_Types\" // File_Types : picture, document, any\n}";
            case 'DATE':
            case 'EMAIL':
            case 'NUMBER':
            case 'PASSWORD':
            case 'TEXT':
            case 'TEXTAREA':
            default: return "{}";
        }
    };

    this.declareExample = function (type) {
        switch (type) {
            case 'CHECKBOX':
            case 'RADIO':
            case 'SELECT':
            case 'SELECT_MULTIPLE': return "{\n  \"lists\": [\n    {\"key\": \"male\", \"text\": \"ชาย\"},\n    {\"key\": \"female\", \"text\": \"หญิง\"},\n    {\"key\": \"other\", \"text\": \"อื่นๆ\"}\n  ]\n}";
            case 'FILE': return "{\n  \"directory\": \"pp6_docs\",\n  \"acceptTypes\": \"picture\"\n}";
            case 'DATE':
            case 'EMAIL':
            case 'NUMBER':
            case 'PASSWORD':
            case 'TEXT':
            case 'TEXTAREA':
            default: return "{}";
        }
    };

    var describeExample = function () {
        var type = this.fieldType.val();
        this.describeField.html("รูปแบบการตั้งค่า:\n"+this.declarePattern(type)+"\n\nตัวอย่าง:\n"+this.declareExample(type));
        if(this.fieldValue) this.fieldValue.html(this.declareExample(type));

        if(type == "CHECKBOX" || type == "RADIO" || type == "SELECT") {
            this.otherField.removeAttr('disabled');
        } else {
            this.otherField.removeAttr('checked');
            this.otherField.attr('disabled', true);
        }
    }.bind(this);

    fieldType.change(describeExample);
    fieldType.trigger('change');

    if(fieldValue.data('default')) this.fieldValue.html(fieldValue.data('default').replace(/'/g, ""));
}