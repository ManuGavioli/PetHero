<?php

namespace Controllers;

use Controllers\UserController as UserController;
Use Models\PHPMailer as PHPMailer;
Use Models\Exception as Exception;
use Models\SMTP as SMTP;
Use Models\User as User;
use Models\Booking as Booking;
use Models\Pet as Pet;




class MailController{

    public function sendConfirmationBooking($booking){
        //require_once(VIEWS_PATH."validate-session.php");

        if ($booking->getPetId()->getMyowner() == null){
            echo "no usser logged in";
        }else{
            
            //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'federicomatiastorres@caraludme.edu.ar';                     //SMTP username
                $mail->Password   = 'matimaster1';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('federicomatiastorres@caraludme.edu.ar', 'PetHero');
                $mail->addAddress($booking->getPetId()->getMyowner()->getEmail());     //Add a recipient

                //Attachments
               /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name*/

                //Content
                $namePet=$booking->getPetId()->getName();
                $nameKeeper=$booking->getKeeperId()->getFirstName();
                $numBooking=$booking->getIdBooking();
                $ini=$booking->getStartDate();
                $fin=$booking->getFinalDate();

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Reserva Aceptada';
                $mail->Body    = '<html> 
                 <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                 <img align="center" border="0" src="https://mlo1wbhvgmgt.i.optimole.com/w:1000/h:500/q:mauto/https://pethero.co.za/wp-content/uploads/2022/08/Pet-Hero_1000x500.png" alt="image" title="image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 80%;max-width: 464px;" width="464"/>
                 <h2 class="text-center">Estamos Muy Felices de Comentarte Que el Cuidador
                 '.$nameKeeper.' acepto tu Pedido para Cuidar a '.$namePet.'</h2>
                 <h3 class="text-center">Ya podras confirmarlo Pagando el 50%
                 en la pestaña de mis Reservas en tu cuenta de PetHero</h3>
                <br>
                 <h3 class="text-center">Detalles del Pedido: </h3>
                 <h3 class="text-center">numero de pedido:'.$numBooking.'</h3>
                 <h3 class="text-center">fecha de inicio: '.$ini.' </h3>
                 <h3 class="text-center">fecha de finalización: '.$fin.' </h3>
                </div>
                 </html>';

                $mail->send();
            } catch (Exception $e) {
                echo "Mail Error: {$mail->ErrorInfo}";
            }
                    }

                }
            }
?>

