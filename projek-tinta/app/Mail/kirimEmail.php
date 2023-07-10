<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class kirimEmail extends Mailable
{
  use Queueable, SerializesModels;

  protected $pdfContent;

  /**
   * Create a new message instance.
   *
   * @param  mixed  $pdfContent
   * @return void
   */
  public function __construct($pdfContent)
  {
    $this->pdfContent = $pdfContent;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('subjek')
      ->attachData($this->pdfContent, 'output.pdf', [
        'mime' => 'application/pdf',
      ]);
  }
}
