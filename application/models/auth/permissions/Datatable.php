<?php

class Datatable extends CI_Model
{
	private $_table = 'permissions';
	private $_column_order = [null, 'a.perm_key', 'a.perm_name', null];
	private $_column_search = [null, 'a.perm_key', 'a.perm_name', null];
	private $_default_order = ['id ' => 'DESC'];

	private function _query()
	{
		// Query
		$q =
			"SELECT a.id, a.perm_key, a.perm_name, a.created_at
            FROM {$this->_table} AS a
            WHERE 1=1 ";

		if (session('tahun')) $q .= " AND YEAR(a.created_at) = " . session('tahun');

		// Records Total
		$return['recordsTotal'] = $this->db->query($q)->num_rows();
		// ========================================================================

		$q .= " HAVING 1=1 AND (1=0";
		$search_value = false;
		foreach ($this->_column_search as $k => $v) {
			if ($v && post("columns[$k][search][value]")) {
				$search_value = true;
				$q .= " OR {$v} LIKE '%" . post("columns[$k][search][value]") . "%'";
			} elseif ($v && post('search[value]')) {
				$search_value = true;
				$q .= " OR {$v} LIKE '%" . post('search[value]') . "%'";
			}
		}

		if ($search_value) $q .= " )";
		else $q .= " OR 1=1)";

		// Records Filtered
		$return['recordsFiltered'] = $this->db->query($q)->num_rows();
		// ========================================================================

		if (!post('order')) $q .= " ORDER BY " . key($this->_default_order) .
			"{$this->_default_order[key($this->_default_order)]}";
		else {
			$q .= " ORDER BY";
			foreach (post('order') as $k => $v) {
				$q .= " {$this->_column_order[$v['column']]} {$v['dir']}";
				if ($k !== count(post('order')) - 1) $q .= ', ';
			}
		}

		if (!is_null(post('start')) && post('length'))
			$q .= " LIMIT " . post('start') . ", " . post('length');

		// Data
		$return['data'] = $this->db->query($q)->result();

		// Query
		$return['query'] = $this->db->last_query();
		return $return;
	}


	public function list()
	{
		$result = $this->_query();
		$no = post('start') + 1;
		$data = [];

		foreach ($result['data'] as  $k => $v) {
			$row = [];
			$row['no'] = $no++;
			$row['id'] = base64_encode($this->encryption->encrypt($v->id));
			$row['perm_key'] = $v->perm_key;
			$row['perm_name'] = $v->perm_name;
			$row['aksi'] = "
				<div role=\"group\" class=\"btn-group btn-group-sm\">
					" . (is_allowed('update-permissions') ? "
					<button type=\"button\" class=\"btn btn-success btn_edit\" data-uuid=\"" . @$v->uuid . "\" data-id=\"" . base64_encode($this->encryption->encrypt($v->id)) . "\" title=\"Ubah Data\">
						<i class=\"fa fa-edit\"></i>
					</button>" : "") . (is_allowed('delete-permissions') ? " 
					<button type=\"button\" class=\"btn btn-danger btn_delete\" data-uuid=\"" . @$v->uuid . "\" data-id=\"" . base64_encode($this->encryption->encrypt($v->id)) . "\" title=\"Hapus Data\">
						<i class=\"fa fa-trash\"></i>
					</button> " : "") . "
				</div>
			";
			$row['created_at'] = $v->created_at;
			$data[$k] = $row;
		}

		return [
			"draw" => post('draw'),
			"recordsTotal" => $result['recordsTotal'],
			"recordsFiltered" => $result['recordsFiltered'],
			"data" => $data,
			"query" => $result['query'],
		];
	}
}
