<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form name="frmRoomType" action="">
            <input type="text" name="name" required placeholder="Room Class">
            <input type="number" name="price_per_night" required placeholder="Price Per Night">
            <input type="number" name="capacity" required placeholder="Capacity">
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>