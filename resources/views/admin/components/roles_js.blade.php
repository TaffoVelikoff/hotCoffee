<script type="text/javascript">
  $('.role').change(function() {
      var selectedRoles = '';

      $('#roles :checked').each(function() {
        selectedRoles += $(this).data('role');
        if($(this)[0] != $('#roles :checked').last()[0]) {
          selectedRoles += ', ';
        }
      });

      if ($("#roles input:checkbox:checked").length > 0) {
        $('#access-nfo').html('{{ __('hotcoffee::admin.page_roles_only') }}: <strong>admin, ' + selectedRoles + '</strong>');
        $('#role-admin').prop( "checked", true );
      } else {
        $('#access-nfo').html('{{ __('hotcoffee::admin.page_roles_all') }}');
        $('#role-admin').prop( "checked", false );
      } 
  });
</script>