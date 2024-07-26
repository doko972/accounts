<?php

/**
 * Generate a unique token and add it to the user session. 
 *
 * @return void
 */
function generateToken()
{
    if (
        !isset($_SESSION['token'])
        || !isset($_SESSION['tokenExpire'])
        || $_SESSION['tokenExpire'] < time()
    ) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

/**
 * Redirect to the given URL.
 *
 * @param string $url
 * @return void
 */
function redirectTo(string $url): void
{
    // var_dump('REDIRECT ' . $url);
    header('Location: ' . $url);
    exit;
}


/**
 * Get from an array a HTML list string
 * @param array $array your array you want in HTML list
 * @param string $ulClass an optional CSS class to add to UL element
 * @param string $liClass an optional CSS class to add to LI elements
 * @return string the HTML list
 */
function getArrayAsHTMLList(array $array, string $ulClass = '', string $liClass = ''): string
{
    // $values = '';
    // foreach($array as $value){
    //     $values .= "<li>{$value}</li>";
    // }

    $ulClass = $ulClass ? ' class="' . $ulClass . '"' : '';
    $liClass = $liClass ? ' class="' . $liClass . '"' : '';

    return '<ul' . $ulClass . '>'
        . implode(array_map(fn ($v) => '<li' . $liClass . '>' . $v . '</li>', $array))
        . '</ul>';
}


/**
 * Get HTML to display errors available in user SESSION
 *
 * @param array $errorsList - Available errors list
 * @return string HTMl to display errors
 */
function getHtmlErrors(array $errorsList): string
{
    if (!empty($_SESSION['errorsList'])) {
        $errors = $_SESSION['errorsList'];
        unset($_SESSION['errorsList']);

        return getArrayAsHTMLList(
            array_map(fn ($e) => $errorsList[$e], $errors),
            'notif-error'
        );
    }
    return '';
}

/**
 * Get HTML to display messages available in user SESSION
 *
 * @param array $messagesList - Available Messages list
 * @return string HTML to display messages
 */
function getHtmlMessages(array $messagesList): string
{
    if (isset($_SESSION['msg'])) {
        $m = $_SESSION['msg'];
        unset($_SESSION['msg']);
        return '<p class="notif-success">' . $messagesList[$m] . '</p>';
    }
    return '';
}


/**
 * Check fo referer
 *
 * @return boolean Is the current referer valid ?
 */
function isRefererOk(): bool
{
    global $globalUrl;
    return isset($_SERVER['HTTP_REFERER'])
        && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
}


/**
 * Check for CSRF token
 *
 * @param array|null $data Input data
 * @return boolean Is there a valid toekn in user session ?
 */
function isTokenOk(?array $data = null): bool
{
    if (!is_array($data)) $data = $_REQUEST;

    return isset($_SESSION['token'])
        && isset($data['token'])
        && $_SESSION['token'] === $data['token'];
}


/**
 * Verify HTTP referer and token. Redirect with error message.
 *
 * @return void
 */
function preventCSRF(string $redirectUrl = 'index.php'): void
{
    if (!isRefererOk()) {
        addError('referer');
        redirectTo($redirectUrl);
    }

    if (!isTokenOk()) {
        addError('csrf');
        redirectTo($redirectUrl);
    }
}

/**
 * Verify HTTP referer and token for API calls
 *
 * @param array $inputData
 * @return void
 */
function preventCSRFAPI(array $inputData): void
{
    if (!isRefererOk()) triggerError('referer');

    if (!isTokenOk($inputData)) triggerError('csrf');
}
/**
 * Add a new error message to display on next page. 
 *
 * @param string $errorMsg - Error message to display
 * @return void
 */
function addError(string $errorMsg): void
{
    if (!isset($_SESSION['errorsList'])) {
        $_SESSION['errorsList'] = [];
    }
    $_SESSION['errorsList'][] = $errorMsg;
}
/**
 * Print an error in json format and stop script.
 *
 * @param string $error Error code from errors array available in _congig.php
 * @return void
 */
function triggerError(string $error): void
{
    global $errors;

    echo json_encode([
        'isOk' => false,
        'errorMessage' => $errors[$error]
    ]);

    exit;
}