import { generateClasses } from "@formkit/themes";
import { defaultConfig } from "@formkit/vue";

// https://formkit.com/guides/create-a-tailwind-theme

const textClassification = {
    input: "input input-bordered max-w-md formkit-invalid:input-error",
};
const boxClassification = {
    fieldset: "max-w-md border rounded-md shadow p-2",
    legend: "font-bold text-sm",
    wrapper: "flex items-center cursor-pointer gap-x-1",
    input: "checkbox",
};

export const formTheme = defaultConfig({
    config: {
        classes: generateClasses({
            global: {
                outer: "formkit-disabled:opacity-70 mb-5",
                inner: "form-control",
                label: "label label-text font-bold",
                help: "mt-1 text-xs",
                messages: "label flex-col items-start",
                message: "label-text-alt text-error",
            },
            button: {
                input: "btn",
            },
            date: textClassification,
            "datetime-local": textClassification,
            checkbox: boxClassification,
            email: textClassification,
            file: {
                label: "block mb-1 font-bold text-sm",
                inner: "max-w-md cursor-pointer",
                input: "file:btn file:mr-2 text-transparent sm:label-text",
                noFiles: "label label-text-alt hidden",
                fileItem: "label label-text-alt sm:hidden",
                fileRemove: "hidden",
            },
            month: textClassification,
            number: textClassification,
            password: textClassification,
            radio: {
                ...boxClassification,
                input: "radio",
            },
            range: {
                inner: "max-w-md",
                input: "range",
            },
            search: textClassification,
            select: {
                input: "select select-bordered max-w-md formkit-invalid:select-error",
            },
            submit: {
                input: "btn btn-primary",
                outer: "flex items-center justify-end px-8 py-4 bg-base-300 mb-0",
            },
            tel: textClassification,
            text: textClassification,
            textarea: {
                input: "textarea textarea-bordered max-w-md formkit-invalid:textarea-error",
            },
            time: textClassification,
            url: textClassification,
            week: textClassification,
        }),
    },
});
