<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);
%>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <%= $pluralHumanName %>
        <?= $this->Html->link('Novo', ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de <%= $pluralHumanName %></h3>

                    <div class="box-tools">
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" class="form-control" placeholder="Digite">
                                <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="submit">Buscar</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <% foreach ($fields as $field): %>
                                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
                            <% endforeach; %>
                            <th>Ações</th>
                        </tr>
                        <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
                            <tr>

                                <% foreach ($fields as $field) {
                                    $isKey = false;
                                    if (!empty($associations['BelongsTo'])) {
                                        foreach ($associations['BelongsTo'] as $alias => $details) {
                                            if ($field === $details['foreignKey']) {
                                                $isKey = true;
                                                %>
                                                <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
                                                <%
                                                break;
                                            }
                                        }
                                    }

                                    if ($isKey !== true) {
                                        if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                                            %>
                                            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                                            <%
                                        } else {
                                            %>
                                            <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                                            <%
                                        }
                                    }
                                }
                                $pk = '$' . $singularVar . '->' . $primaryKey[0];
                                %>
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link('Editar', ['action' => 'edit', <%= $pk %>], ['class'=>'btn btn-primary btn-xs']) ?>
                                    <?= $this->Form->postLink('Excluir', ['action' => 'delete', <%= $pk %>], ['confirm' => 'Você tem certeza que deseja excluir este registro?', 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php echo $this->Paginator->numbers(); ?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->

