	 m�.hm��{�ę ��w�S��If&̶�����V=��YY������wg���[�/W��i�x\T�'�B,i6���*$m�VǪ�n�\���&�1�+o�	�M,X��-B?�b5t!���,�{ZЍ�~K636�"�lD�0�y`�J��z��ȍ��u�<����J-C0�b��Oh��!In�7�{���HQMzcm���U����Lo�̜5�l��`�q���V��`��T�Dd,=��PK0�L������~9^�g��lT�d��,}#��AVǒi[s��]|�]�V>o�-B߈�[1�i��	Y)aK���J
,�F;0�L0��^���>g����d�ۗE%9��#jh	?������#�x�C��ͯ�������\g��.���~�z�Se|z��H�=�Gk�ĝ�ۘEY^��8�f����ᲂج���97�q���T|jۤ	�꩕6v4�<���f|4�.���y[�Ư!��^�w���k��̲3V�Ɠz筺Z�{6�ONb<쓆��0pyf1V�鼍o9�%&~&u?�MN���`pZFdˣ��3m���3=�2��E�jm䕊!�7,.�|`@/\�I�����c��3t�l��m�_�߸xR����V�N��w!���+G8�EL�p|�&D�5���!�L_�F|�2��=[����e�v��~�*�w+f<O� ]9;��D%,�ʉ��0x|,�`/l� *P;�ʡ>hq4}�&�ڟ{�O��:�R�����B3����\3���'�ϏQ~���9�&��>?�����eT�|̜f�cĪ�����˩e5v�xIѡi[՛M�(�v@�lw��Z�a$m]g��mǧ�3�F�F-�*�AދXW}��OXn3�e�?収�z���g�+klP3�NƊ���i�7&.��Ye�kD\<$\��R��(:B��6�cN��(4<��=2�p�Y�;��g�t݈�߾�V5l�D��Ǹ��x����SO�T��'5�]i��Lٞ�?�_)�sf����L�M�i��Fb���l=�z]�������}����T`W&1�z�N� >�=P�?���w+w��j8�`�2�3�����'b�!�?�C=t("j\4�c}�-�n\����@�����Eϊ^�����)]��E_$���=�	6U�g���`J�!ڷ��#ڡ�N���G G��Dh�kF��~iUv�H��.;x/+����������_]6(r/N�� :B����&���d����-RVd!�Ě��4�D��:���
$9��<�����v9����|?������������Aj�/1�Ob	t�7I�s�%��e{���_�y�ґmiA_ �O�ddH��4�\� R]?����?��R�Ď���~t�'	�W�x`��)�n��ڽkW���E�`��M�����]�)��r��%�������;����c��N�T��b�+[�T�(D
����<��rL܏�۪�OU���_8?��/Z��Fii�͟���"N�+�gM�s%f���OR�S����4Iw���z������v��Q��_Ub~9A��P�)�h��*��$ ��8�Lu�&�'O��k=`�/��@���#A9�
�ա]�����(�&���*�:Ak��,���\��!��/���Iԋ9�m�>m5�o�����"<\H�43!���<�X	X��WGʐ���X�]#�O�� ^�R�q��>�Z_�hlʦn����Q�79���%V��`��S�#a½Y����Q�}�C�w�ƛ�LW��Wbh,U��1����.{H"�pp��?�5�uv���ƾ�F^���y���Rz�o"��
rl�Z�&]�3���[�ٱ���� ӝ>����E��"s/�nh ��i�o氊�|�m���,��1ha�c�zz�K<}��·5(]yA~,�<0y�m��E�՟�j����*}�K��� ���F�m�\s�< s��!�U��5�P7�   ?>
					</li>
		  <li class="nav-item">
						<a href="#0" class="nav-link" id="cd-cart-trigger">CART</a>
			</ul>
					</li>				
    		</ul>
			
			
		</div>
		</nav>
<?php # DISPLAY POST MESSAGE FORM.

# Access session.
//session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Post Message' ;

# Display form.
echo '<br><br><br><br><br>';
echo '<form style="text-align:center;" action="post_action.php" method="post" accept-charset="utf-8">
<p>Subject:<br><input style="width:50%;" name="subject" type="text" size="64" maxlength="100"></p>
<p>Message:<br><textarea style="width:50%"; name="message" rows="5" cols="50"></textarea></p><br>
<p><input style="width:100px; height:60px; text-align:center;" name="submit" type="submit" value="Submit"></p></form>';


# Create navigation links.
//echo '<p><a href="forum.php">Forum</a> | <a href="shop.php">Shop</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

# Display footer section.
?>