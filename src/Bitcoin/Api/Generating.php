<?php
/**
 * User: delboy1978uk
 * Date: 18/08/15
 * Time: 19:51
 */

namespace Del\Bitcoin\Api;


class Generating extends AbstractApi
{
    /**
     * The generate RPC nearly instantly generates
     * blocks (in regtest mode only)
     *
     * @param int $blocks The number of blocks to generate. The RPC call
     * will not return until all blocks have been generated
     * @return mixed
     */
    public function generate($blocks)
    {
        return $this->send('generate',[$blocks]);
    }

    /**
     * The getgenerate RPC returns true if the node is set to
     * generate blocks using its CPU.
     *
     * @return mixed
     */
    public function getGenerate()
    {
        return $this->send('getgenerate');
    }

    /**
     * The setgenerate RPC enables or disables hashing to attempt
     * to find the next block.
     *
     * @param bool $enable Set to true to enable generation;
     * set to false to disable generation
     * @param int $processors The number of processors to use. Defaults to 1.
     * Set to -1 to use all processors
     * @return mixed
     */
    public function setGenerate($enable,$processors)
    {
        return $this->send('generate',[$enable,$processors]);
    }
}