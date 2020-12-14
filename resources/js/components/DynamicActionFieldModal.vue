<template>
  <confirm-action-modal
    v-if="dynamicAction"
    v-bind="{ working, resourceName, selectedResources, errors }"
    :action="dynamicAction"
    @confirm="$emit('confirm')"
    @close="$emit('close')"
  />
  <modal
    v-else
    tabindex="-1"
    role="dialog"
    @click.native="$emit('close')"
  >
    <div
      class="flex items-center justify-center z-50 p-6"
      style="min-height: 150px"
    >
      <loader class="text-60" />
    </div>
  </modal>
</template>

<script>
export default {
  name: 'dynamic-action-field-modal',

  props: {
    working: Boolean,
    resourceName: { type: String, required: true },
    action: { type: Object, required: true },
    selectedResources: { type: [Array, String], required: true },
    errors: { type: Object, required: true },
  },

  data() {
    return {
      dynamicAction: null,
    };
  },

  methods: {
    loadAction() {
      this.dynamicAction = null;
      window.axios.get(`/nova-vendor/dynamic-action-fields/${this.resourceName}/dynamic-fields`, {
        params: {
          resources: Array.isArray(this.selectedResources) ? this.selectedResources.join(',') : this.selectedResources,
          action: this.action.uriKey,
        },
      }).then((resp) => {
        this.dynamicAction = resp.data;
        this.action.fields = this.dynamicAction.fields;
      });
    },
  },

  mounted() {
    this.loadAction();
  },

  watch: {
    action() {
      this.loadAction();
    },
    resourceName() {
      this.loadAction();
    },
    selectedResources() {
      this.loadAction();
    },
  },
}
</script>
