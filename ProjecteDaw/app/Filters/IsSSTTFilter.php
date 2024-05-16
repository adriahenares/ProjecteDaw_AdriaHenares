<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsSSTTFilter implements FilterInterface
{
    /**
     * Comprova que sols quan ets SSTT iestas logat pots accedir
     * 
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!isset(session()->mail) || !isset(session()->idCenter)) {
            return redirect()->back()->withInput();
        } else {
            if (isset(session()->role) == true && session()->role != "SSTT") {
                if ( session()->role != "Admin") {
                    return redirect()->back()->withInput();    
                }
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
