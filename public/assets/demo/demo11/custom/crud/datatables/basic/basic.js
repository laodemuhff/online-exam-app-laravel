var DatatablesBasicBasic = {
    init: function() {
        var a;
        (a = $("#m_table_1")).DataTable({
            order: [
                [1, "desc"]
            ]
        })
    }
};
jQuery(document).ready(function() {
    DatatablesBasicBasic.init()
});