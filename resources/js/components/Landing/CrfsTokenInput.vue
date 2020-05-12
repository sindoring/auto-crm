<template>
  <input type="hidden" name="_token" :value="csrf">
</template>

<script>
export default {
  name: 'CrfsTokenInput',
  data: () => ({
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
  }),
};
</script>

<style>

</style>
