                    <?php if ($products):foreach($products as $productCount => $product): ?>
                    <tr>
                      <td class="taL <?php if ($productCount % 2 == 1): ?>bg01<?php endif; ?>"><?php echo $product['product_name']; ?></td>
                      <td class="<?php if ($productCount % 2 == 1): ?>bg01<?php endif; ?>">
                        <?php if ($product['file_exists10']): ?>
                        <a href="javascript:void(0);" onclick="set_param('<?php echo $product['id']; ?>','contents10','');"><img src="../images/ico_pdf01.png" width="16" height="16" alt="PDF"></a>
                        <?php endif; ?>
                      </td>
                      <td class="<?php if ($productCount % 2 == 1): ?>bg01<?php endif; ?>">
                        <?php if ($product['file_exists11']): ?>
                        <a href="javascript:void(0);" onclick="set_param('<?php echo $product['id']; ?>','contents11','');"><img src="../images/ico_dxf01.png" width="16" height="16" alt="DXF"></a>
                        <?php endif; ?>
                      </td>
                      <td class="<?php if ($productCount % 2 == 1): ?>bg01<?php endif; ?>">
                        <?php if ($product['file_exists20']): ?>
                        <a href="javascript:void(0);" onclick="set_param('<?php echo $product['id']; ?>','contents20','');"><img src="../images/ico_pdf01.png" width="16" height="16" alt="PDF"></a>
                        <?php endif; ?>
                      </td>
                      <td class="<?php if ($productCount % 2 == 1): ?>bg01<?php endif; ?>">
                        <?php if ($product['file_exists30']): ?>
                        <a href="javascript:void(0);" onclick="set_param('<?php echo $product['id']; ?>','contents30','');"><img src="../images/ico_pdf01.png" width="16" height="16" alt="PDF"></a>
                        <?php endif; ?>
                      </td>
                      <td class="<?php if ($productCount % 2 == 1): ?>bg01<?php endif; ?>">
                        <?php if ($product['file_exists40']): ?>
                        <a href="javascript:void(0);" onclick="set_param('<?php echo $product['id']; ?>','contents40','');"><img src="../images/ico_pdf01.png" width="16" height="16" alt="PDF"></a>
                        <?php endif; ?>
                      </td>
                      </tr>
                    <?php endforeach; endif; ?>