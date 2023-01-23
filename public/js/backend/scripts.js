function obj(d) {
    let appendeddata = {};
    $.each($("#filter_form").serializeArray(), function () {
        d[this.name] = this.value;
    });
    return d;
}