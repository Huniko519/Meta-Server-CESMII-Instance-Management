<template>
  <span>
    <a v-bind:href="'/organizations/' + dataId">Detail</a> | <a href='/vms/add'>Add Instance</a>
  </span>
</template>
<script>
export default {
  setup(props) {
    const cellValue = props.params.valueFormatted ? props.params.valueFormatted : props.params.value;
    const dataId = props.params.data.id;
    const buttonClicked = () => alert(`${cellValue} medals won!`);

    // props.params contains the cell & row information and is made available to this component at creation time
    // see ICellRendererParams for more details
    return {
      cellValue,
      buttonClicked,
      dataId
    }
  }
};
</script>