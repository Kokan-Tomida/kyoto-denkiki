<?php

/*--------------------------------------------------------------------------
	�ե�����᡼�� - sformmmail2
	(c)Sapphirus.Biz

	�����Υ�����ץȤ�ʸ�����󥳡��ɤ� euc-jp �����ѹ����ʤ��ǲ�������
--------------------------------------------------------------------------*/

// ��ư�ֿ���Subject�ʷ�̾��
$replySubject = '�ڥ��ץȥ��쥯�ȥ�˥����ۥ���ץ뵡�߽ФΤ�������';

//������å�����
$replyMessage = <<< EOD
{$sfm_mail->tantou}��
�����٤ϥ��ץȥ��쥯�ȥ�˥����Υ���ץ뵡�߽Ф�
�������ߤ��꤬�Ȥ��������ޤ���
�ɤä�����ô����ꤴϢ�����夲�ޤ���
-------------------------------------------------------------------------
���̾
{$sfm_mail->cname}

͹���ֹ�
{$sfm_mail->zip}

��ƻ�ܸ�
{$sfm_mail->address1}

������
{$sfm_mail->address2}

TEL
{$sfm_mail->tel}

FAX
{$sfm_mail->fax}

ô������
{$sfm_mail->busyo}

��ô����̾
{$sfm_mail->tantou}

�᡼�륢�ɥ쥹
{$sfm_mail->email}

�ڤ���˾�ߤ��Ф����ơ�

����
1.���� {$sfm_mail->syomei01}
2.���� {$sfm_mail->syomei02}

�Ÿ�
{$sfm_mail->dengen01}
�Ÿ����� {$sfm_mail->dengen02}

��Ĺ�����֥�
�Ÿ����� {$sfm_mail->cable01} {$sfm_mail->cable02} ��
{$sfm_mail->cable03}{$sfm_mail->cable04} m

�ߤ��Ф���˾��
{$sfm_mail->kiboubi01}ǯ{$sfm_mail->kiboubi02}��{$sfm_mail->kiboubi03}��

�ֵ�ͽ����
{$sfm_mail->yoteibi01}ǯ{$sfm_mail->yoteibi02}��{$sfm_mail->yoteibi03}��

�о�ʪ���
{$sfm_mail->work01}

������礭��
{$sfm_mail->work02}

��Υ
�����-���� {$sfm_mail->kyori01}
����-��� {$sfm_mail->kyori02}

��������
{$sfm_mail->kensa}
-------------------------------------------------------------------------
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
Power Electronics and Optelectronics
Kyoto Denkiki Co.,Ltd.
+++++++++++++++++++++++++++++++++++++
�����ŵ���������
��611-0041
�����ܱ���������Į��ϻ19-1
���á�0774-25-7710
e-mail��products@kdn.co.jp

�������ݥ졼�ȥ�����
http://www.kdn.co.jp/
���ѥ���쥯�ȥ�˥���������
http://kdn-products.com/power/
�����ץȥ��쥯�ȥ�˥���������
http://kdn-products.com/opt/
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
EOD;

?>
