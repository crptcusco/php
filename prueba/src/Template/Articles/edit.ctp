<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit Article</h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '4']);
    echo $this->Form->button(__('Guardar artículo'));
    echo $this->Form->end();
?>