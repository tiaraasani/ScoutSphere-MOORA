<?php

declare(strict_types=1);

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class FormUiHelperTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        helper('form_ui');

        session()->setFlashdata('errors', [
            'kode'     => 'Kolom Kode wajib diisi.',
            'values.3' => 'Nilai C3 harus berupa angka.',
            'nama'     => 'Nama berisi <b>tag</b>.',
        ]);
    }

    protected function tearDown(): void
    {
        session()->remove('errors');

        parent::tearDown();
    }

    public function testFieldIdIsStableAndSafeForDottedNames(): void
    {
        $this->assertSame('field-kode', field_id('kode'));
        $this->assertSame('field-values-3', field_id('values.3'));
        $this->assertSame('field-values-3', field_id('values[3]'));
    }

    public function testFieldErrorReturnsMessageOrNull(): void
    {
        $this->assertSame('Kolom Kode wajib diisi.', field_error('kode'));
        $this->assertSame('Nilai C3 harus berupa angka.', field_error('values.3'));
        $this->assertNull(field_error('bobot'));
    }

    public function testFieldClassAppendsInvalidOnlyWhenFieldHasError(): void
    {
        $this->assertSame('form-control is-invalid', field_class('kode'));
        $this->assertSame('form-control', field_class('bobot'));
        $this->assertSame('custom-select is-invalid', field_class('kode', 'custom-select'));
    }

    public function testFieldDescribedbyLinksToErrorElement(): void
    {
        $this->assertSame(' aria-describedby="field-kode-error" aria-invalid="true"', field_describedby('kode'));
        $this->assertSame('', field_describedby('bobot'));
    }

    public function testFieldFeedbackRendersEscapedMessage(): void
    {
        $this->assertSame(
            '<div class="invalid-feedback" id="field-kode-error">Kolom Kode wajib diisi.</div>',
            field_feedback('kode')
        );
        $this->assertSame(
            '<div class="invalid-feedback" id="field-nama-error">Nama berisi &lt;b&gt;tag&lt;/b&gt;.</div>',
            field_feedback('nama')
        );
        $this->assertSame('', field_feedback('bobot'));
    }
}
