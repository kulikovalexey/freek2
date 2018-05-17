<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($event->id))
        <option value="0" @if ($event->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($event->published == 1) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Наименование</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок категории" value="{{ $event->title or "" }}" required>

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" placeholder="Автоматическая генерация" value="{{ $event->slug or "" }}" readonly="">

<label for="">Дата проведения</label>

<div class='input-group date' id='datetimepicker1'>
    <input type='text' class="form-control"/>
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
    </span>
</div>
<script type="text/javascript">
    $(function () {
        var year = moment().get('year');
        var month = moment().get('month');
        var startDate = moment([year, month]);
        var endDate = moment(startDate).endOf('month');

        $('#date_check').datetimepicker({
            format: 'DD.MM.YYYY',
            locale: 'ru',
            minDate: startDate,
            maxDate: endDate
        });
    });
</script>
<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">