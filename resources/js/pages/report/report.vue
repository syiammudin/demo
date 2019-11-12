<template id="">
<div class="">
  <div >
      <allRequest :type='type' />
      <approveReject :type='type' />
      <addChangeDelete :type='type' />
      <VendorByTypeSupplier :type='type' />
      <!-- <allRequest :type='type' v-if="type == 'all_request'" />
      <approveReject :type='type' v-if="type == 'approve_and_reject'" />
      <addChangeDelete :type='type' v-if="type == 'add_change_delete'" />
      <VendorByTypeSupplier :type='type' v-if="type == 'vendor_type_supplier'" /> -->
  </div>
</div>
</template>


<script type="text/javascript">
  import allRequest from './all_request_status'
  import approveReject from './approve_and_reject'
  import addChangeDelete from './add_change_delete'
  import VendorByTypeSupplier from './vendor_type_supplier'
  export default {
      props : ['type'],
      components : {
        allRequest, approveReject, addChangeDelete, VendorByTypeSupplier
      },
  }

</script>
