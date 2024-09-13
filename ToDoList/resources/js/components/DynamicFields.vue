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
                <option v-if="as === 'select'" v-for="option in attrs.options" :key="option.value" :value="option.value">
                    {{ option.text }}
                </option>
            </Field>
            <ErrorMessage :name="name" class="text-danger"/>
        </div>

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
