<?php
function isAdmin($conn, $uid) {
    $sql = "SELECT level FROM userinfo WHERE uid = $uid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $level = $row['level'];
        if ($level == 0) {
            return false;
        }
        if ($level == 1) {
            return true;
        }
    }
    return false;
}
