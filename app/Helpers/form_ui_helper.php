<?php

declare(strict_types=1);

/**
 * Small view helpers for rendering validation state on form fields.
 *
 * Validation errors are flashed to the session under the `errors` key,
 * indexed by field name (dot notation for array fields, e.g. `values.3`).
 */

if (! function_exists('field_id')) {
    /**
     * Stable element id for a form field, safe for dotted array names.
     */
    function field_id(string $field): string
    {
        return 'field-' . str_replace(['.', '[', ']'], ['-', '-', ''], $field);
    }
}

if (! function_exists('field_error')) {
    /**
     * Returns the validation message for a field, or null when valid.
     */
    function field_error(string $field): ?string
    {
        $errors = session()->getFlashdata('errors');

        return is_array($errors) && isset($errors[$field]) ? (string) $errors[$field] : null;
    }
}

if (! function_exists('field_class')) {
    /**
     * Control class list with `is-invalid` appended when the field has an error.
     */
    function field_class(string $field, string $base = 'form-control'): string
    {
        return field_error($field) === null ? $base : $base . ' is-invalid';
    }
}

if (! function_exists('field_describedby')) {
    /**
     * `aria-describedby` attribute pointing to the error element, when present.
     */
    function field_describedby(string $field): string
    {
        return field_error($field) === null ? '' : ' aria-describedby="' . field_id($field) . '-error" aria-invalid="true"';
    }
}

if (! function_exists('field_feedback')) {
    /**
     * Renders the inline error element for a field, or nothing when valid.
     */
    function field_feedback(string $field): string
    {
        $message = field_error($field);

        if ($message === null) {
            return '';
        }

        return '<div class="invalid-feedback" id="' . field_id($field) . '-error">' . esc($message) . '</div>';
    }
}
