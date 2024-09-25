<template>
    <Form @submit="handleSubmit">
        <div v-for="{as, name, label, ...attrs} in schema.fields" :key="name">
            <label :for="name">
                {{label}}
            </label>
            <Field
                :as="as"
                :id="name"
                :name="name"
                v-bind="attrs"
            >
                <!-- Render slot based on the field name -->
                <template v-if="$slots[name]">
                    <slot :name="name"/>
                </template>
            </Field>
            <ErrorMessage :name="name" class="text-danger"/>
        </div>

        <slot name="selection"/>

        <div>
            <button class="btn btn-primary">{{this.submitText}}</button>
        </div>
    </Form>
</template>

<script>
import { Form, Field, ErrorMessage } from "vee-validate";

export default {
    components: {
        ErrorMessage,
        Form,
        Field,
    },
    props: {
        schema: {
            type: Object,
            required: true,
        },
        submitText: {
            type: String,
            default: "Submit",
        },
    },
    methods: {
        handleSubmit(value) {
            this.$emit("onSubmit", value);
        },
    },
};
</script>
