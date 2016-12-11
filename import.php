<script type="text/javascript">
function QuickImageMap(){
    $.fn.QuickMap.defaults = {
    fill: true,
    fillColor: '{{ fillcolor | removehash}}',
    fillOpacity: 0,
    stroke: true,
    strokeColor: '{{ strokecolor | removehash}}',
    strokeOpacity: 1,
    strokeWidth: {{ strokewidth }},
    fade: true,
    alwaysOn: false,
    neverOn: false,
    groupBy: false,
    wrapClass: true,
    // plenty of shadow:
    shadow: false,
    shadowX: 0,
    shadowY: 0,
    shadowRadius: {{ shadowradius }},
    shadowColor: '{{ shadowcolor | removehash}}',
    shadowOpacity: 0.8,
    shadowPosition: 'outside',
    shadowFrom: false
    }
};
$(function() {
    $('.QuickMap').QuickMap({
        fillColor: 'ffffff'
    });
});
</script>
<script type="text/javascript" src="https://www.imagemap.in/quickmap/QuickMap.js"></script>