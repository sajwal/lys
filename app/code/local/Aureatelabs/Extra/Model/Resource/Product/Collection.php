<?php

class Aureatelabs_Extra_Model_Resource_Product_Collection extends Mage_Reports_Model_Resource_Product_Collection {

    public function getProductViews($p_id = '') {
        $resource = Mage::getResourceModel('reports/event');
        $select = $resource->getReadConnection()->select()
                ->from(array('ev' => $resource->getMainTable()), array(
                    'product_id' => 'object_id',
                    'view_count' => new Zend_Db_Expr('COUNT(*)')
                ))
                // join for the event type id of catalog_product_view
                ->join(
                        array('et' => $resource->getTable('reports/event_type')), "ev.event_type_id=et.event_type_id AND et.event_name='catalog_product_view'", ''
                )
                ->group('ev.object_id')

                // add required filters
                ->where('ev.object_id IN(?)', $p_id);

        $result = $resource->getReadConnection()->fetchRow($select);
        $view_count = 0;
        if($result['view_count']>0)
            $view_count = $result['view_count'];

        return $view_count;
    }
}