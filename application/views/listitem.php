

		<? foreach ($rows as $id=>$row): ?>
            <tr>
            	<td><?= $id ?></td>
            	<? foreach ($row as $cell): ?>
            		<td><?= html::anchor($controller . '/detail/'.$id, trim($cell)); ?></td>
        		<? endforeach; ?>		
            
            </tr>
            
            
        <? endforeach; ?>