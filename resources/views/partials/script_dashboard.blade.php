<script src="{{ asset('assets_dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/template.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/settings.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/todolist.js') }}"></script>
<script src="{{ asset('assets_dashboard/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('assets_dashboard/vendors/chart.js/Chart.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script src="{{ asset('assets_dashboard/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/select2.js') }}"></script>
{{-- <script src="{{ asset('assets_dashboard/js/dashboard.js') }}"></script> --}}
<script src="{{ asset('assets_dashboard/js/file-upload.js') }}"></script>
<script src="{{ asset('assets_dashboard/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets_dashboard/js/typeahead.js') }}"></script>


<script>
    new DataTable('#datatable', {
        "language": {
            "emptyTable": '<img src="{{ asset('custom/data4.gif') }}" alt="No Data" class=" w-25 h-25"><p>No data available</p>'
        }
    });
</script>

{{-- <script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "emptyTable": '<img src="{{ asset('custom/data3.gif') }}" alt="No Data" style="width: 100%"><p>No data available</p>'
            }
        });
    });
</script> --}}
